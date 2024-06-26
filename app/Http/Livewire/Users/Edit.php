<?php

namespace App\Http\Livewire\Users;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $new_profile = null;
    public $old_profile = null;
    public $first_name = '';
    public $check = '';
    public $last_name = '';
    public $email = '';
    public $phone = '';
    public $role = '';
    public $password = '';
    public $user;
    public $status;
    public $isEditMode = false;

    public $saved = false;

    

    public function mount(Request $request){
        if(isset($request->user)){
            $this->user = User::find($request->user);
            $this->isEditMode = true;
            $this->old_profile = $this->user->profile;
            $this->first_name = $this->user->first_name;
            $this->last_name = $this->user->last_name;
            $this->email = $this->user->email;
            $this->phone = $this->user->phone;
            $this->status = $this->user->status;

        }
    }

        /**
     * @return array
     */
    public function rules()
    {
        $rules =  [
            "first_name" => 'required',
            "last_name" => 'required',
            "email" => 'email',
            "phone" => 'required',
            "status" => 'required',
        ];

        if(!$this->isEditMode){
            $rule["email"] = 'required|email|unique:users,email';
            $rule["password"] = 'required';
        }
        return $rules;
    }

    public function save(){
        $data = $this->withValidator(function (Validator $validator) {
            $validator->after(function (Validator $validator) {
                if(!$this->isEditMode && !isset($this->new_profile)){
                    $validator->errors()->add('logo', 'The Logo field is required.');
                    return;
                }
            });
        })->validate();

        if (isset($this->new_profile)){
            $data['profile'] = $this->new_profile->store('profiles') ;
        }
        if($this->isEditMode){
            if(isset($this->new_profile)){
                try{
                    unlink("storage/".$this->user->profile);
                }catch ( \Exception $exception){
    
                }
            }

            $this->user->update($data);

            $this->emit("success", "User updated successfully!");
        }else{
            $this->user = User::create([
                'name' => $this->first_name.' '.$this->last_name,
                'first_name'=>$this->first_name,
                'last_name'=>$this->last_name,
                'phone'=>$this->phone,
                'profile'=>$data['profile'],
                'admin'=>$this->status,
                'email'=>$this->email,
                'password'=>Hash::make($this->password)
            ]);
            $this->user->refresh();
            $this->emit("success", "User updated successfully!");
        }
        $this->saved = true;
        $this->emit("userCreated");

    }

    public function generate(){
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz!"$%&//(()=?+';
        $this->password = substr(str_shuffle($data), 0, 8);
    }

    public function render()
    {
        return view('livewire.users.edit');
    }
}
