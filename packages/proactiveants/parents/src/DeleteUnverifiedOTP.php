<?php

namespace ProactiveAnts\Parents;

use Illuminate\Console\Command;
use ProactiveAnts\Parents\ParentsAppVerificationCode;


class DeleteUnverifiedOTP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proactiveants:deleteotp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete any unvrified OTP after five minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('The delete unverified opt deleting process has began...');
        $otps = ParentsAppVerificationCode::all();
        foreach($otps as $otp){
            $now = \Carbon\Carbon::now();
            if($otp->expired_at < $now){
                $otp->delete();
            }
        }
        $this->info('The task has been completed without any issue...');
    }
}
