<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Illuminate\Contracts\Validation\Validator;
use Livewire\Component;

class Edit extends Component
{


    public $showModal = false;
    public $isEditMode = false;

    public ?int $isNew = null;
    public ?Category $category = null;

    public $type = "";
    public $name = "";

    protected $listeners = [
        'load'=>'load'
    ];

    public function mount($type){
        $this->type = $type;
    }


    public function render()
    {
        return view('livewire.categories.edit');
    }

    public function load(?Category $category){
        $this->category = $category;
        if(isset($this->category) && $this->category->exists){
            $this->isEditMode = true;
            $this->type = $category->type;
            $this->name = $category->name;
        }else{
            $this->isEditMode = false;
            $this->name = "";
        }
        $this->showModal = true;
    }

    protected $rules = [
        "name" => 'required',
        "type" => 'required',
    ];

    public function save(){
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {

            });

        })->validate();


        if($this->isEditMode){
            $this->category->update($data);
            $this->emit("success", "Category updated successfully!");

        }else{
            $this->category->create($data);
            $this->emit("success", "Category created successfully!");
        }
        $this->emit("categoryCreated");
        $this->showModal = false;
    }

    public function updatedShowModal($value){
        if(!$value){
            $this->name= "";
        }
    }
}


