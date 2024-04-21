<?php

namespace App\Http\Livewire\Constant;

use App\Models\Constant;
use Livewire\Component;

class Edit extends Component
{
    public $showModal = false;

    public Constant $constant;

    protected $listeners = [
        'load'=>'load'
    ];

    public $name;
    public $value;

    public function load(Constant $constant){
        $this->constant = $constant;
        $this->name = $constant->name;
        $this->value = $constant->value;
        $this->showModal = true;
    }

    public function save(){
        $this->constant->value = $this->value;
        $this->constant->save();
        $this->emit('editedConst');
        $this->emit('success', 'Save Success');
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.constant.edit');
    }
}
