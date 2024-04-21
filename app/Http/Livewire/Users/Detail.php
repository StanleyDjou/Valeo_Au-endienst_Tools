<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class Detail extends Component
{

    public User $user;
    public $user_id;
    public $tab = 0;

    public $menus = ['Trips'];

    public function mount(User $user, Request $request){
        $this->user = $user;
        $this->user_id = $this->user->id;
        $this->tab = $request->tab;
    }
    public function render()
    {
        return view('livewire.users.detail');
    }
}
