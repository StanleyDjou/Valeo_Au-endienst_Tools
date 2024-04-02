<?php

namespace App\Http\Livewire\Skills;

use App\Models\Skill;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Contracts\Validation\Validator;

class AddSub extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $isEditMode = false;

    public ?Skill $parent = null;

    public $image = null;

    public $parent_name = '';
    public $skill_id = null;
    public $name = "";

    protected $listeners = [
        'load'=>'load'
    ];

    public function load(?Skill $skill){
        $this->parent = $skill;
        $this->parent_name = $skill->name;
        $this->skill_id = $this->parent->id;
        $this->showModal = true;
    }

    protected $rules = [
        "name" => 'required',
        "skill_id" => 'required',
    ];

    public function save(){
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {
            });

        })->validate();
            if(isset($this->image)){
                $data["image"] = $this->image->store('images');
            }
            Skill::create($data);
            $this->emit("success", "skill created successfully!");
        $this->emit("skillCreated");
        $this->showModal = false;
    }


    public function updatedShowModal($value){
        if(!$value){
            $this->name= " ";
        }
    }
    public function render()
    {
        return view('livewire.skills.add-sub');
    }
}
