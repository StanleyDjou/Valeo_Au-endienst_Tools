<?php

namespace App\Http\Livewire\Categories;

use App\Http\Livewire\DataTable\DataTable;
use App\Models\Category;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    use DataTable;

    public ?Category $category;

    public function render()
    {
        return view('livewire.categories.index', ['categories' => $this->rows]);
    }

    protected $listeners = [
        'categoryCreated' => '$refresh',
        'categoryDeleted' => '$refresh',
    ];

    public $type = "blog";

    public function mount(Request  $request)
    {
        $this->type = $request->get('type', 'blog');
        $this->resetFilters();
        $this->resetSort();
        $this->perPage = 15;
        $this->page = 1;
        if(isset($request->category)){
            $this->category_id = $request->category;
            $this->category = Category::find($this->category_id);
            $this->type =  $this->category->type;
        }


    }

    public ?int $category_id = null;

    protected function getBaseQuery()
    {
        if(isset($this->category_id)){
            return Category::query()->select('categories.*')->whereType($this->type)->whereParentId($this->category_id);
        }else{
            return Category::query()->select('categories.*')->whereType($this->type)->whereNull('parent_id');
        }
    }

    public function resetFilters()
    {
        $this->filters = ["name"=>''];
    }

    /**
     * Configure sort when loading the page or switching the tab group
     *
     * @return void
     */
    private function resetSort()
    {
        $this->sortField = 'created_at';
        $this->sortDirection = 'desc';
    }


    public function filterName($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query;
    }
}

