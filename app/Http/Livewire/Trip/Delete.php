<?php

namespace App\Http\Livewire\Trip;

use App\Models\Trip;
use App\Models\UserTrip;
use Livewire\Component;

class Delete extends Component
{
    public $showModal = false;
    public Trip $trip;

    protected $listeners = [
        'load'=>'load'
    ];

    /**
     * @param Trip $trip
     */
    public function load(Trip $trip){
        $this->trip = $trip;
        $this->showModal = true;
    }

    public function delete(){
        foreach(UserTrip::all() as $triping){
            if($triping->trip_id === $this->trip->id){
                $triping->delete();
            }
        }
        $this->trip->delete();
        $this->emit("success", "trip deleted successfully!");
        $this->emit("tripDeleted");
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.trip.delete');
    }
}
