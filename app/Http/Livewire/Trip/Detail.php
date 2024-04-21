<?php

namespace App\Http\Livewire\Trip;

use App\Models\Trip;
use Livewire\Component;

class Detail extends Component
{
    public $trip;
    public $type;
    public $workers;

    protected $listeners = [
        'userAdded' => '$refresh'
    ];
    public function mount(Trip $trip){
        $this->trip = $trip;
        $this->workers = $trip->workers;
    }
    public function render()
    {
        return view('livewire.trip.detail');
    }
}


