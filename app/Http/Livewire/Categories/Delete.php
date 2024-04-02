<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class Delete extends Component
{
    public $showModal = false;
    public Category $categories;

    protected $listeners = [
        'load'=>'load'
    ];


    public function render()
    {
        return view('livewire.categories.delete');
    }

    /**
     * @param Category $categories
     */
    public function load(Category $categories){
        $this->categories = $categories;
        $this->showModal = true;
    }

    public function delete(){
        if($this->categories->blogs->count() === 0 &&  $this->categories->faqs->count() === 0 && $this->categories->products->count() === 0 && $this->categories->categories->count() === 0){
            $this->categories->delete();
            $this->emit("success", "categories deleted successfully!");
            $this->emit("categoryDeleted");
            $this->showModal = false;
        }else{
            $this->emit("error", "This category cannot be deleted!");
        }
    }

}

