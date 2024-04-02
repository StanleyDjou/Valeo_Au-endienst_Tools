<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Illuminate\Contracts\Validation\Validator;
use Livewire\Component;

class AddSub extends Component
{
    public $showModal = false;
    public $isEditMode = false;

    public ?Category $category = null;
    public ?Category $parent = null;
    public $type = "";
    public $name = "";

    public $parent_id = null;

    protected $listeners = [
        'load'=>'load'
    ];

    public function render()
    {
        return view('livewire.categories.add-sub');
    }

    public function load( ?Category $parent, ?Category $category){
        $this->category = $category;
        $this->parent = $parent;
        if(isset($this->category) && $this->category->exists){
            $this->isEditMode = true;
            $this->type = $category->type;
            $this->name = $category->name;
            $this->parent_id = $parent->id;
        }else{
            $this->type = $parent->type;
            $this->isEditMode = false;
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
            $this->emit("success", "Sub Category updated successfully!");

        }else{
            $this->parent->createSub($data);
            $this->emit("success", "SubCategory created successfully!");
        }
        $this->emit("categoryCreated");
        $this->showModal = false;
    }

    public function updatedShowModal($value){
        if(!$value){
            $this->name= " ";
            $this->type= " ";
        }
    }
}
