<?php

namespace App\Http\Livewire\Trip;

use App\Models\User;
use Livewire\Component;
use App\Http\Livewire\DataTable\DataTable;
use App\Models\Trip;
use Illuminate\Http\Request;

class Index extends Component
{
    use DataTable;
    protected $listeners = [
        'tripCreated'=>'$refresh',
        'tripDeleted'=>'$refresh',
    ];
    public $trip_state;


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
        $this->trip_state = $request->get('trip_state');
    }

    protected function getBaseQuery()
    {
        if(isset($this->trip_state)){
            return Trip::query()->select('trips.*')->where('state', $this->state);
        }
        return Trip::query()->select('trips.*');
        
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
        return view('livewire.trip.index', ['trips'=>$this->rows]);
    }
}
