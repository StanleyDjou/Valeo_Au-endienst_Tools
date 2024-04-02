<?php

namespace App\Http\Livewire\Skills;

use Livewire\Component;
use App\Http\Livewire\DataTable\DataTable;
use App\Models\Skill;
use Illuminate\Http\Request;

class Index extends Component
{
    use DataTable;

    public ?Skill $skill;

    public ?int $skill_id = null;
    protected $listeners = [
        'skillCreated' => '$refresh',
        'skillDeleted' => '$refresh',
    ];


    public function mount(Request  $request)
    {
        $this->resetFilters();
        $this->resetSort();
        $this->perPage = 15;
        $this->page = 1;
        if(isset($request->skill)){
            $this->skill_id = $request->skill;
            $this->skill = Skill::find($this->skill_id);
        }


    }


    protected function getBaseQuery()
    {
        if(isset($this->skill_id)){
            return Skill::query()->select('skills.*')->whereSkillId($this->skill_id);
        }else{
            return Skill::query()->select('skills.*')->whereNull('skill_id');
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
    public function render()
    {
        return view('livewire.skills.index', ['skills' => $this->rows]);
    }
}
