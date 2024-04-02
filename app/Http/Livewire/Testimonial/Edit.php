<?php

namespace App\Http\Livewire\Testimonial;

use App\Models\testimonial;
use Illuminate\Contracts\Validation\Validator;
use Livewire\Component;

class Edit extends Component
{

    public $showModal = false;
    public $isEditMode = false;

    public ?testimonial $testimonial = null;

    public $name = "";
    public $company = "";
    public $testimony = "";

    public function render()
    {
        return view('livewire.testimonial.edit');
    }


    protected $listeners = [
        'load'=>'load'
    ];

    public function load(?testimonial $testimonial){
        $this->testimonial = $testimonial;
        if(isset($this->testimonial) && $this->testimonial->exists){
            $this->isEditMode = true;
            $this->name = $testimonial->testimony;
            $this->company = $testimonial->company;
            $this->testimony = $testimonial->testimony;
        }else{
            $this->isEditMode = false;
        }
        $this->showModal = true;
    }

    protected $rules = [
        "name" => 'required',
        "company" => 'required',
        "testimony" => 'required',
    ];

    public function save(){
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {

            });
        })->validate();


        if($this->isEditMode){
            $this->testimonial->update($data);
            $this->emit("success", "Testimonial updated successfully!");
        }else{
            $this->testimonial->create($data);
            $this->emit("success", "Tastimonial created successfully!");
        }
        $this->emit("testimonialCreated");
        $this->showModal = false;
    }


    public function updatedShowModal($value){
        if(!$value){
            $this->name= "";
            $this->company= "";
            $this->testimony= "";
        }
    }
}
