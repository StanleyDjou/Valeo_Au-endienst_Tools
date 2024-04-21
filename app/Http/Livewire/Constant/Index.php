<?php

namespace App\Http\Livewire\Constant;

use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'editedConst' => '$refresh'
    ];
    public function render()
    {
        return view('livewire.constant.index');
    }
}
