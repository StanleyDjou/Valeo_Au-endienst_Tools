<?php

namespace App\Http\Livewire\Users\Services;

use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;

class Index extends Component
{

    public User $user;
    public $trips;
    public function mount(User $user){
        $this->user = $user;
        $this->trips = $user->trips;
    }

    public function render()
    {
        return view('livewire.users.services.index');
    }
}
