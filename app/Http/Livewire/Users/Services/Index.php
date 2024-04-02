<?php

namespace App\Http\Livewire\Users\Services;

use App\Models\User;
use App\Models\UserService;
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

    public User $user;
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


    public function mount(Request $request, $user_id)
    {
        $this->resetFilters();
        $this->resetSort();
        $this->perPage = 15;
        $this->page = 1;
        $this->user = User::find($user_id);
    }

    protected function getBaseQuery()
    {
        return UserService::query()->select('user_services.*')->where('user_id', $this->user->id);
        
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
        return view('livewire.users.services.index', ['services'=>$this->rows]);
    }
}
