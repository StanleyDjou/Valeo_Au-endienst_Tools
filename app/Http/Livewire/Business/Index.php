<?php

namespace App\Http\Livewire\Business;

use App\Models\User;
use Livewire\Component;
use App\Http\Livewire\DataTable\DataTable;
use Illuminate\Http\Request;

class Index extends Component
{
    use DataTable;
    protected $listeners = [
        'userCreated'=>'$refresh',
        'userDeleted'=>'$refresh',
    ];


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
    }

    protected function getBaseQuery()
    {
        return User::query()->select('users.*')->where('admin', 0)->whereRole('worker');
        
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


    public function render()
    {
        return view('livewire.business.index', ['users' => $this->rows]);
    }
}
