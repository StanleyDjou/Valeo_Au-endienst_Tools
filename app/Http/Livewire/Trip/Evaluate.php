<?php

namespace App\Http\Livewire\Trip;

use App\Models\Trip;
use Livewire\Component;

class Evaluate extends Component
{
    public Trip $trip;

    public function mount(Trip $trip){
        $this->trip = $trip;
    }
    public function render()
    {
        return view('livewire.trip.evaluate');
    }
}
