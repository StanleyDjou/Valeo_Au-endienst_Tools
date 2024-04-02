<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class Delete extends Component
{   
    public $showModal = false;
    public User $user;

    protected $listeners = [
        'load'=>'load'
    ];

    /**
     * @param User $user
     */
    public function load(User $user){
        $this->user = $user;
        $this->showModal = true;
    }

    public function delete(){
        try{
            unlink('public/'.$this->user->profile);
        }catch(\Exception $e ){
            $this->emit('error', "An error occurred while deleting");
            return;
        }
        $this->user->delete();
        $this->emit("success", "user deleted successfully!");
        $this->emit("userDeleted");
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.users.delete');
    }
}
