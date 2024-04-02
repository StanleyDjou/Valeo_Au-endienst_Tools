<?php

namespace App\Http\Livewire\Users\Portfolio;

use App\Models\Portfolio;
use Livewire\Component;

class Detail extends Component
{
    public Portfolio $portfolio;

    public function mount(Portfolio $portfolio){
        $this->portfolio = $portfolio;
    }
    public function render()
    {
        return view('livewire.users.portfolio.detail');
    }
}
