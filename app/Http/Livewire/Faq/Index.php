<?php

namespace App\Http\Livewire\Faq;

use App\Http\Livewire\DataTable\DataTable;
use App\Models\FAQ;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    use DataTable;

    public function render()
    {
        return view('livewire.faq.index',['faqs'=>$this->rows]);
    }

    protected $listeners = [
        'faqCreated'=>'$refresh',
        'faqDeleted'=>'$refresh',
    ];


    protected function getBaseQuery()
    {
        return FAQ::query()->select('faqs.*');
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

        return $query;
    }
}
