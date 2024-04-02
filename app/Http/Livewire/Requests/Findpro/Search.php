<?php

namespace App\Http\Livewire\Requests\Findpro;

use App\Models\Cities;
use App\Models\Regions;
use App\Models\Skill;
use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $showModal = true;

    public $advance_search = false;

    public $search_value = '';
    
    public $category = '';

    public $categories = [];

    public $sub_category = '';

    public $sub_categories = [];

    public $region = '';

    public $regions = [];

    public $city = '';
    public $cities = [];

    public $search_array = [];

    protected $listeners = [
        'load' => 'load',
        
    ];

    public function mount($showModal){
            $this->categories = Skill::whereNull('skill_id')->get();
            $this->regions = Regions::all();
            $this->advance_search = true;
            if(isset($showModal)){
                $this->showModal = $showModal;
            }
    }

    public function load(){
        
        $this->showModal = true;
        
    }

    public function set_sub(){
        $this->sub_categories = Skill::where('skill_id', Skill::where('name', $this->category)->first()->id)->get();
    }

    public function set_cities(){
        $this->cities = Cities::where('region_id', Regions::where('name', $this->region)->first()->id)->get();;
    }

    public function search(){
        if(($this->search_value == '')){
            $this->search_array = [];
        } else {
            $this->search_array = User::where('company', 'like', "%{$this->search_value}%")->take(4)->get();
        }
    }

    public function setAdvance(){
        $this->advance_search =!$this->advance_search;
    }
    public function render()
    {
        
        return view('livewire.requests.findpro.search');
    }
}
