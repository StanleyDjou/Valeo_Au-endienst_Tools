<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog;
use App\Models\Category;
use Livewire\Component;

class Detail extends Component
{
    public $blog;
    public $type;
    public $meta_data = [];

    public function mount(Blog $blog){
        $this->blog = $blog;
        $this->type = $blog->type;
    }
    public function render()
    {
        $category = Category::all();
        return view('livewire.admin.blog.detail', ['categories'=>$category]);
    }
}
