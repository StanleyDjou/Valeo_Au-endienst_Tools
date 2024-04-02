<?php

namespace App\Console;

use App\Models\Invoice;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InvoiceReminder;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function (){
            foreach(Invoice::all() as $invoice){
                if($invoice->due_days_left()<=20 && $invoice->due_days_left() >= 0 && $invoice->amount_to_pay()>0){
                    try{
                      $invoice_no = $invoice->id;
                      $amount_left = $invoice->amount_to_pay();
                      $days_left = floor($invoice->due_days_left());
                      $detail_route = route('invoice.detail', $invoice);
                      $details['greeting'] = 'Hi,';
                      $details['subject'] = 'Invoice Due Reminder';
                      $details['body'] = "<p>Your purchase with invoice number : <b> {$invoice_no} </b> have not been settled completely, you are reminded to pay and upload your proof of payment to the platform </p>
                                          <p>Amount To Pay : {$amount_left} FCFA</p>
                                          <p>Days Remaining Before Due : {$days_left}</p>
                                          <p>Click <a href = '{$detail_route}'>here</a> to upload payment</p>
                                          ";
                     
                          Notification::send($invoice->client(), new InvoiceReminder($details));
                      }catch(\Exception $e){
                        info($e);
                      }
                 }
              }
        })->dailyAt('10:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
