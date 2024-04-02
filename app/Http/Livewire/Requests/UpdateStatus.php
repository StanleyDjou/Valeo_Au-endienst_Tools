<?php

namespace App\Http\Livewire\Requests;

use App\Models\Request;
use App\Models\User;
use App\Notifications\StatusUpdated;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $showModal = false;
    public Request $request;
    public $status;

    protected $listeners = [
        'load'=>'load'
    ];

    /**
     * @param Request $request
     */
    public function load(Request $request, $status){
        $this->request = $request;
        $this->status = $status;
        $this->showModal = true;
    }

    public function change(){
        $this->request->status = $this->status;
        $this->request->save();

        //Notification to the admin that changed the status
        $admins = User::where('admin', '1')->get();

        //$detail_route = route("transactions.details",["type"=>$this->transaction->type, 'id'=>$this->transaction->id]);
        $trans_no = $this->request->id;
        $status = $this->status;
        //Notification to the admin that changed the status
        $details['greeting'] = 'Hi admin,';
        $details['subject'] = 'Request Status Changed';
        $details['body'] = "<p>The  status of the Request number {$trans_no} has been marked as {$status}  </p>
                            <p>Click <a href = '{}'>here</a> to know more</p>";
        try{
            Notification::send($admins, new StatusUpdated($details));
        }catch(\Exception $e){
            $this->emit('error', 'An error occured. please try again later');
        }

        //Notification to the user that applied


            $details['greeting'] = 'Hi,';
            $details['subject'] = 'Request Status Changed';
            $details['body'] = "<p>The  status of your transaction requested number {$trans_no} has been marked as {$status}  </p>
                                <p>Click <a href = '{}'>here</a> to know more</p>";
            $user = $this->request->user;
            try{
                Notification::send($user, new StatusUpdated($details));
            }catch(\Exception $e){
                $this->emit('error', 'An error occured. please try again later');
            }

        $this->emit("success", "Request Status Changed successfully!");
        $this->emit("statusChanged");
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.requests.update-status');
    }
}
