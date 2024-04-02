<?php

namespace App\Http\Livewire;

use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class Notifications extends Component
{
    public function render()
    {
        return view('livewire.notifications');
    }

    protected $listeners = ['mark_as_read'];

    public function mark_as_read(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        $this->emit("success", "Notification is marked as read");
        $this->emit('$refresh');
    }
}
