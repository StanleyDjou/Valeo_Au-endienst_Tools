<?php

namespace App\Http\Livewire\Trip;

use App\Models\Constant;
use App\Models\Trip;
use Livewire\Component;
use Illuminate\Contracts\Validation\Validator;

class Edit extends Component
{
    public $showModal = false;

    public $start_date = null;
    public $end_date = null;

    public $isEditMode = false;
    public $distance;
    public $hotel_price;

    public $booking_site = "https://www.booking.com/searchresults.html?ss=";
    public $location_site = "https://www.google.com/maps/dir/";

    public ?Trip $trip;



    public $title = "";
    public $location;
    public $description = "";




    protected $listeners = [
        'load'=>'load'
    ];


    public function load(?Trip $trip){
        $this->trip = $trip;
        if(isset($this->trip) && $this->trip->exists){
            $this->isEditMode = true;
            $this->title = $trip->title;
            $this->start_date = $trip->start_date;
            $this->hotel_price = $trip->hotel_price;
            $this->distance = $trip->distance;
            $this->end_date = $trip->end_date;
            $this->description = $trip->description;
            $this->location = $trip->location;
        }else{
            $this->isEditMode = false;
        }
        $this->showModal = true;
    }


    protected $rules = [
        "title" => 'required',
        "start_date" => 'required',
        "description" => 'required',
        "hotel_price"=>'nullable',
        "distance"=>'nullable',
        "end_date" =>  'required',
        "location" => 'required',

    ];

    public function add_site(){
        $this->booking_site = $this->booking_site.$this->location;
        $this->location_site = $this->location_site.Constant::find(4)->value.'/'.$this->location;
    }

    public function save(){
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {
            });

        })->validate();
        if($this->isEditMode){
            $this->trip->update($data);
            $this->emit("success", "trip updated successfully!");

        }else{

            $this->trip->create($data);
            $this->emit("success", "trip created successfully!");
        }
        $this->emit("tripCreated");
        $this->showModal = false;


    }


    public function updatedShowModal($value){
        if(!$value){
            $this->title= "";
            $this->start_date = null;
            $this->end_date = null;
            $this->description= "";
            $this->emit("tripCreated");
            $this->showModal = false;
        }
    }
    public function render()
    {
        return view('livewire.trip.edit');
    }
}
