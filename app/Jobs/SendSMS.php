<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use ProactiveAnts\SMS\SMSMessage;
use GuzzleHttp\Client;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sms;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SMSMessage $sms)
    {
        $this->sms = $sms;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Fire a sms
        $mobile = $this->sms->phone_number;
        // Check is there a zero in front of numner
        if(substr($mobile,0,1)==0){
            $mobile = substr($mobile,1,strlen($mobile)-1);
            $mobile = "94" . $mobile;
        }
        elseif(substr($mobile,0,1)=="+"){
            $mobile = substr($mobile,1,strlen($mobile)-1);
        }
        else{
            $mobile = "94" . $mobile;
        }
        $message = $this->sms->message;
        $client = new Client();
        $response = $client->request('GET', 'https://cpsolutions.dialog.lk/index.php/cbs/sms/send?destination='. $mobile . '&q='. config('sms.api') .'&message='. $message);
        if($response->getBody()=="0")
        {
            $this->sms->delivery = 1;
            $this->sms->save();
        }
    }
}
