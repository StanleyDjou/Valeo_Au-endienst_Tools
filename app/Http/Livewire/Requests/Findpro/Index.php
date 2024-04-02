<?php

namespace App\Http\Livewire\Requests\Findpro;

use App\Http\Livewire\DataTable\DataTable;
use App\Models\Cities;
use App\Models\Regions;
use App\Models\Skill;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $showModal = true;

    use DataTable;

    public $regions = [];
    public $region;
    public $region_id;
    public $city_id;
    public $city;
    public $category;
    public $sub_category;
    public $categories = [];
    public $sub_categories = [];
    public $cities = [];


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

    public function mount(\Illuminate\Http\Request $request)
    {
        if(count($request->all())>0){
            $this->showModal = false;
        }

        $this->regions = Regions::all();

        $this->categories = Skill::whereNull('skill_id')->get();

        $this->resetFilters();

        if(isset($request->category)){
            $this->filters['category'] = [$request->category];
        }

        if(isset($request->region)){
            $this->filters['region'] = $request->region;
            $query = $this->getBaseQuery();
            $this->applyFilters($query);
            $this->cities = [];
            $this->filters['city'] = "";
            $this->filters['state'] = "";
        }

        if(isset($request->name)){
            $this->filters['name'] = $request->name;
        }
        $this->resetSort();
        $this->perPage = 15;
        $this->page = 1;
    }

    public function set_sub(){
        $this->sub_categories = Skill::where('skill_id', Skill::where('name', $this->region)->first()->id)->get();
    }

    public function set_cities(){
        $this->cities = Cities::where('region_id', Regions::where('name', $this->region)->first()->id)->get();;
    }

    protected function getBaseQuery()
    {
        return User::query()->select('users.*')->where('admin', 0)->whereRole('worker');
    }

    public function resetFilters()
    {
        $this->filters = [
            "name"=>'',
            "category"=>[],
            "region"=>'',
            "city"=>'',
        ];
    }

    public function filterName($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query->where('company','like',"%{$value}%");
    }

    public function filterRegion($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query->where('region_id', Regions::where('name', $value)->first()->id);
    }

    public function filterCity($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query->where('city_id', Cities::where('name', $value)->first()->id);
    }

    public function filterCategory($query, $value)
    {
        if (count($value) === 0) {
            return $query;
        }

        return;
    }


    public function updated($key)
    {
        if($key == "filters.region"){
            $query = $this->getBaseQuery();
            $this->applyFilters($query);
            $this->cities = [];
            $this->filters['city'] = "";
            $this->filters['region'] = "";
        }

        if($key == "filters.category"){
            $query = $this->getBaseQuery();
            $this->applyFilters($query);
        }
    }
    public function render()
    {
        return view('livewire.requests.findpro.index', ['businesses'=>$this->rows]);
    }
}
