<?php

namespace App\Http\Livewire\Skills;

use App\Models\Skill;
use Livewire\Component;

class Delete extends Component
{
    public $showModal = false;
    public ?Skill $skill;

    public $isParent = false;

    protected $listeners = [
        'load'=>'load'
    ];



    /**
     * @param Skill $skill
     */
    public function load(Skill $skill){
        $this->skill = $skill;
        $this->isParent = $skill->isParent();
        $this->showModal = true;
    }

    public function delete(){
        if($this->skill->isParent()){
            foreach($this->skill->children() as $child){
                if(isset($child->image)){
                    unlink('storage/'.$child->image);
                }
                $child->delete();
            }
            if(isset($this->skill->image)){
                unlink('storage/'.$this->skill->image);
            }
            $this->skill->delete();
            $this->emit("success", "skill deleted successfully!");
            $this->emit("skillDeleted");
            $this->showModal = false;
            return;
        }
        if(isset($this->skill->image)){
            unlink('storage/'.$this->skill->image);
        }
        $this->skill->delete();
        $this->emit("success", "skill deleted successfully!");
        $this->emit("skillDeleted");
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.skills.delete');
    }
}
