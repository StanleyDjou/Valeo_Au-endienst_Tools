<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{
    public $showModal = false;
    public User $user;
    public $current_password = '';
    public $new_password = '';
    public $repeat_password = '';

    public $listeners = ['load'=>'load', 'passwordUpated'=>'$refresh'];


    public function save(){
        $this->user = auth()->user();
        if($this->current_password == '' || $this->new_password == '' || $this->repeat_password == ''){
            $this->emit('error', 'You must fill all the fields'); 
            return;
        }

        if (Hash::check($this->current_password, $this->user->password)){
            if($this->new_password == $this->repeat_password){
                $this->user->password = Hash::make($this->new_password);
                $this->user->save();
                $this->emit('success', 'Password changed successively');
                $this->emit('passwordUpdated');
                $this->repeat_password = '';
                $this->new_password = '';
                $this->current_password = '';
                return ;
                }
            $this->emit('error', 'Repeated password and New password missmatch');
            return;
        }
        $this->emit('error', 'The current password is incorrect'); 
    }
    public function render()
    {
        return view('livewire.change-password');
    }
}
