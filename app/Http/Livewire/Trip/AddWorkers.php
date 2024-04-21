<?php

namespace App\Http\Livewire\Trip;

use App\Models\User;
use App\Models\UserTrip;
use Livewire\Component;
use Illuminate\Contracts\Validation\Validator;

class AddWorkers extends Component
{
    public $showModal = false;

    public $user_id = null;
    public $trip_id = null;

    public $users;
    public $isEditMode = false;
    public $role = "";




    protected $listeners = [
        'load'=>'load'
    ];

    public function mount(){
        $this->users = User::where('admin', 0)->get();
    }


    public function load($trip_id){
        $this->trip_id = $trip_id;
        
        $this->showModal = true;
    }


    protected $rules = [
        "user_id" => 'required',
        "trip_id" => 'required',
        "role" => 'required',

    ];

    public function save(){
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {
            });

        })->validate();
        $trip = new UserTrip();
        $trip->create($data);
        $this->emit("success", "trip created successfully!");
        $this->emit("userAdded");
        $this->showModal = false;


    }


    public function updatedShowModal($value){

    }
    public function render()
    {
        return view('livewire.trip.add-workers');
    }
}
