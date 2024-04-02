<?php

namespace App\Http\Livewire\Blog;

use App\Http\Livewire\DataTable\DataTable;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    use DataTable;

    public $type ;
    protected $listeners = [
        'blogCreated'=>'$refresh',
        'blogDeleted'=>'$refresh',
    ];
    public function render()
    {
        $categories = Category::all();
        return view('livewire.blog.index',['blogs'=>$this->rows, 'categories'=>$categories]);
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


    public function mount(Request $request)
    {
        $this->resetFilters();
        $this->resetSort();
        $this->perPage = 15;
        $this->page = 1;
        $this->type = $request->get('type', 'text');
    }

    protected function getBaseQuery()
    {
        return Blog::query()->select('blogs.*')->whereType($this->type);
    }

    public function resetFilters()
    {
        $this->filters = ["name"=>''];
    }

    public function filterName($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query;
    }
}
