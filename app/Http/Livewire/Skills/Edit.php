<?php

namespace App\Http\Livewire\Skills;

use App\Models\Skill;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Contracts\Validation\Validator;

class Edit extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $isEditMode = false;

    public ?Skill $skill = null;

    public $image = null;
    public $name = "";

    protected $listeners = [
        'load'=>'load'
    ];

    public function load(?Skill $skill){
        $this->skill = $skill
;
        if(isset($this->skill) && $this->skill->exists){
            $this->isEditMode = true;
            $this->name = $skill->name;
        }else{
            $this->isEditMode = false;
        }
        $this->showModal = true;
    }

    protected $rules = [
        "name" => 'required',
    ];

    public function save(){
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {
                if(!$this->isEditMode && !isset($this->image)){
                    $validator->errors()->add('images', 'The Image field is required.');
                    return;
                }
            });

        })->validate();


        if($this->isEditMode){
            if(isset($this->image)){
                $data["image"] = $this->image->store('images');
                try{
                    unlink('storage/'. $this->skill->image);
                }catch (\Exception $e){

                }
            }
            $this->skill->update($data);
            $this->emit("success", "skill updated successfully!");



        }else{
            $data["image"] = $this->image->store('images');
            $this->skill->create($data);
            $this->emit("success", "skill created successfully!");
        }
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
        return view('livewire.skills.edit');
    }
}
