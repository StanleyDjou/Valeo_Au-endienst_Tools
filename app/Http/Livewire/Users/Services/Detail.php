<?php

namespace App\Http\Livewire\Users\Services;

use App\Models\UserService;
use Livewire\Component;

class Detail extends Component
{
    public UserService $service;

    public function mount(UserService $service){
        $this->service = $service;
    }

    public function render()
    {
        return view('livewire.users.services.detail');
    }
}
