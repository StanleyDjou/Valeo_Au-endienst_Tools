<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class AdminController extends Controller
{
    //

    protected $search = [
        'q' => null,
        'limit' => 20
    ];

    public function index(Request $request)
    {
        $search = $this->search;
        $admins = new User();

        if ($request->get('q')) {
            $search['q'] = $request->get('q');
            $admins = $admins->where('name', 'like', '%' . $search['q'] . '%');
        }

        if ($request->get('limit')) {
            $search['limit'] = $request->get('limit');
        }
        $user = Auth()->user();
        $id = $user->id;
        $admins = $admins->where('id', '!=', $id)->where('admin', '1')->paginate($search['limit']);

        return view('admin.admin.index', compact('admins', 'search'));
    }


    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('admin.admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required'       => __('Name required'),
            'email.required' => __('Email required'),
            'email.email'         => __('Email must of type email'),
            'email.unique'         => __('This email is already in use by another'),
            'phone.required'         => __('Phone number required'),
            'role.required'    =>__('Role is required'),
            'password.required'         => __('Password required'),
            'password.min'         => __('Password must have at least 8 characters'),
            'password.confirmed'         => __('Password does not matched'),
        ];

        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'email'         => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string'],
            'role' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (User::where(['email'=>$request->email])->count() > 0){
            return redirect()->back()->with('error', "This email is already in use by another");
        }

        try {
            \DB::beginTransaction();
            $admin_role = new UserRole();
            $admin = new User();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->admin = 1;
            $admin->phone = $request->phone;
            $admin->password = \Hash::make($request->password);
            $admin->save();
            $admin_role->user_id = $admin->id;
            $admin_role->role_id = $request->role;
            $admin_role->save();
            \DB::commit();
            return redirect()->to(route('admin.administrator.index'))->with('success', "admin created successfully");

        } catch (Exception $e) {
            \DB::rollback();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $admin = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.admin.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'name.required'       => __('Name required'),
            'phone.required'         => __('Phone number required'),
            'password.required'         => __('Password required'),
            'role.required'             => __('Role is required'),
            'password.min'         => __('Password must have at least 8 characters'),
            'password.confirmed'         => __('Password does not matched'),
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'email'         => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string'],
            'role' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            \DB::beginTransaction();
            $admin_R = UserRole::where('user_id', $id)->first();
            $admin_R->delete();

            $admin_Nr = new UserRole();
            $admin = User::findOrFail($id);
            $admin->name = $request->name;
            // $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->password = \Hash::make($request->password);

            $admin->save();
            $admin_Nr->user_id = $admin->id;
            $admin_Nr->role_id = $request->role;
            $admin_Nr->save();
            \DB::commit();
            session()->flash('success', 'Admin updated successfully');
            return redirect()->back();
        } catch (Exception $e) {
            \DB::rollback();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            \DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->delete();
            foreach ($user->roleR as $role) {
                $role->delete();
            }
            \DB::commit();
            session()->flash('success', 'Admin deleted successfully');
            return redirect()->to(route('admin.administrator.index'));
        } catch (Exception $e) {
            \DB::rollback();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
}
