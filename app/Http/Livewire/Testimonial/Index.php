<?php

namespace App\Http\Livewire\Testimonial;

use App\Http\Livewire\DataTable\DataTable;
use App\Models\Category;
use App\Models\testimonial;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    use DataTable;

    protected $listeners = ['testimonialCreated'=>'$refresh', 'testimonialDeleted'=>'$refresh'];

    public function render()
    {
        return view('livewire.testimonial.index',['testimonial'=>$this->rows]);
    }

    protected function getBaseQuery()
    {
        return testimonial::query()->select('testimonials.*');
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


    public function mount(Request $request){
        $this->resetFilters();
        $this->resetSort();
        $this->perPage = 15;
        $this->page = 1;
    }


    public function filterName($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query->where('name','like',"%($value)%");
    }
}
