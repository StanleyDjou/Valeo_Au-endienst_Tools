<?php

namespace App\Http\Livewire\Testimonial;

use App\Models\testimonial;
use Livewire\Component;

class Delete extends Component
{
    public function render()
    {
        return view('livewire.testimonial.delete');
    }

    public $showModal = false;
    public testimonial $testimonial;

    protected $listeners = [
        'load'=>'load'
    ];


    public function load(testimonial $testimonial){
        $this->testimonial = $testimonial;
        $this->showModal = true;
    }

    public function delete(){
        $this->testimonial->delete();
        $this->emit("success", "testimony deleted successfully!");
        $this->emit("testimonyDeleted");
        $this->showModal = false;
    }
}
