<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;
    public $user;

    public $title = '';

    public $phone = '';

    public $email = '';

    public $profile_picture = null;

    public $old_profile_picture = '';
    protected $listeners = ['profileUpdated'=>'$refresh'];
    public function mount(){
        $this->user = auth()->user();
        $this->phone = auth()->user()->phone;
        $this->email = auth()->user()->email;
        $this->title = auth()->user()->name;
        $this->old_profile_picture = auth()->user()->profile;
    }

    public function update(){
        if( $this->phone == $this->user->phone && $this->email == $this->user->email && $this->title == $this->user->name && !isset($this->profile_picture)){
            $this->emit("error", "No changes detected");
            return;
        }
        $this->user->name = $this->title;
        $this->user->phone= $this->phone;
        $this->user->email = $this->email;
        if(isset($this->profile_picture)){
            if($this->old_profile_picture != ''){
                unlink('storage/'.$this->old_profile_picture);
            }
            $this->user->profile = $this->profile_picture->store('images');
        }
        $this->user->save();
        $this->emit("success", "Profile Updated Successively");
        $this->emit('profileUpdated');
        unset($this->profile_picture);
    }
    public function render()
    {
        return view('livewire.update-profile');
    }
}
