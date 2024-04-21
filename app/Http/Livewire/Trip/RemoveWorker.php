<?php

namespace App\Http\Livewire\Trip;

use App\Models\Trip;
use App\Models\User;
use App\Models\UserTrip;
use Livewire\Component;

class RemoveWorker extends Component
{
    public $showModal = false;
    public Trip $trip;
    public User $user;

    protected $listeners = [
        'load'=>'load'
    ];

    /**
     * @param Trip $trip
     * @param User $user
     */
    public function load(Trip $trip, User $user){
        $this->trip = $trip;
        $this->user = $user;
        $this->showModal = true;
    }

    public function delete(){
        foreach(UserTrip::all() as $triping){
            if($triping->trip_id === $this->trip->id && $triping->user_id === $this->user->id){
                $triping->delete();
            }
        }
        $this->emit("success", "trip deleted successfully!");
        $this->emit("userAdded");
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.trip.remove-worker');
    }
}
