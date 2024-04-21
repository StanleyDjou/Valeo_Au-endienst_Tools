<?php

namespace App\Http\Livewire\Trip;

use App\Models\Trip;
use Livewire\Component;

class UpdateStatus extends Component
{
    public ?Trip $trip;
    public $status;


    public $showModal = false;

    protected $listeners = [
        'load'=>'load'
    ];

    public function load(Trip $trip, $status){
        $this->status = $status;
        $this->trip = $trip;
        $this->showModal = true;

    }

    public function updateStatus(){
        $this->trip->state = $this->status;
        $this->trip->save();
        $this->emit("success", "status updated successfully!");
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.trip.update-status');
    }
}
