<?php

namespace App\Http\Livewire\Requests;

use App\Models\Request;
use Livewire\Component;

class Detail extends Component
{

    protected $listeners = [
        'statusChanged' => '$refresh'
    ];
    public Request $request;

    public function mount(Request $request){
        $this->request = $request;
    }
    public function render()
    {
        return view('livewire.requests.detail');
    }
}
