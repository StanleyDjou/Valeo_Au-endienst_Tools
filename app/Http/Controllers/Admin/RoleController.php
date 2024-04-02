<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function index(){
        $data['roles'] = \App\Models\Role::all();
        return view('admin.roles.index')->with($data);
    }

    public function show($id){
        $role=Role::findOrFail($id);
        $users=[];
        $userR=UserRole::where('role_id',$id)->get();
        foreach($userR as $userR){
            $user=User::findOrFail($userR->user_id);
            array_push($users, $user);
        }
        return view('admin.roles.show', compact('role','users'));
    }


    public function store(Request $request)
    {
        if(Auth()->user()->can('manage_roles')){
            $this->validate($request, [
                'name' => 'required',
                'permissions' => 'required',
            ]);
            \DB::beginTransaction();
            try{
                $role = new \App\Models\Role();
                $role->name = $request->name;
                $role->slug = str_replace(" ","_",strtolower($request->name));
                $role->save();

                foreach($request->permissions as $perm){
                    \DB::table('role_permissions')->insert([
                        'role_id' => $role->id,
                        'permissions_id'=>$perm,
                    ]);
                }
                \DB::commit();
                $request->session()->flash('success', $request->role.' saved successfully');
            }catch(\Exception $e){
                \DB::rollback();
                $request->session()->flash('error', $e->getMessage());
            }
        }else{
            $request->session()->flash('error', "Not Permitted to perform this action");
        }
        return redirect()->to(route('admin.roles.index'));
    }

    public function destroy(Request $request, $id)
    {
        if ( Auth()->user()->can('manage_roles')) {
            //Code goes here
            $role = Role::findOrFail($id);

            if($role->users->count()){
                session()->flash('error', 'This Role is used already');
                return redirect()->back();

            }else{
                $role->delete();

                session()->flash('success', 'Role deleted successfully');
                return redirect()->back();
            }
        }
        $request->session()->flash('error', "Can't delete this role");
        return redirect()->to(route('admin.roles.index'));
    }

    public function edit($id){
        $role= \App\Models\Role::findOrFail($id);


        return view('admin.roles.edit', compact('role'));
    }

    public function create(Request $request){
        return view('admin.roles.create');
    }


    public function update(Request $request, $slug){
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);

        \DB::beginTransaction();
        try{
            if($slug !== 'admin'){
                $role = \App\Models\Role::whereSlug($slug)->first();
                $role->name = $request->name;
                $role->save();
                foreach ($role->permissionsR as $pem){
                    $pem->delete();
                }
                foreach($request->permissions as $perm){
                    \DB::table('role_permissions')->insert([
                        'role_id' => $role->id,
                        'permissions_id'=>$perm,
                    ]);
                }
                \DB::commit();
                $request->session()->flash('success', $request->role.' role saved successfully');
            }else{
                $request->session()->flash('error', "Can't edit this role");
            }
        }catch(\Exception $e){
            \DB::rollback();
            $request->session()->flash('error', $e->getMessage());
        }

        return redirect()->to(route('admin.roles.index'));
    }


    public function permissions(Request $request){
        $data['permissions'] = [];
        if($request->role){
            $data['permissions'] = \App\Models\Role::whereSlug($request->role)->first()->permissions;
        }else{
            $data['permissions'] = \App\Models\Permissions::all();
        }
        return view('admin.roles.permissions')->with($data);
    }

    public function rolesView(){
        $users = \App\Models\User::where('id','!=',auth()->user()->id)->get();
        return view('admin.roles.assign',compact('users'));
    }

    public function rolesStore(Request $request){
        $this->validate($request, [
            'user_id' => 'required',
            'role_id' => 'required',
        ]);

        $user = \App\Models\User::find($request->user_id);
        if($user->hasRole('admin')){
            $role = \App\Models\Role::find($request->role_id);
            \DB::beginTransaction();
            try{
                if($user == null || $role == null){
                    abort(404);
                }

                foreach ($user->roleR as $r){
                    $r->delete();
                }
                \DB::table('user_roles')->insert([
                    'role_id' => $role->id,
                    'user_id'=>$user->id,
                ]);
                \DB::commit();
                $request->session()->flash('success', $request->role.' Role saved successfully');

            }catch(\Exception $e){
                \DB::rollback();
                $request->session()->flash('error', $e->getMessage());
            }
        }else{
            $request->session()->flash('error', "Can't perform this action, you don't have the permissions");
        }
        return redirect()->to(route('admin.roles.index'));
    }
}
