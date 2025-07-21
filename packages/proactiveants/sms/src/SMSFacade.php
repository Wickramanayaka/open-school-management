<?php

namespace ProactiveAnts\SMS;

use Illuminate\Support\Facades\Facade;

class SMSFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'sms';
    }
}