<?php

namespace ProactiveAnts\Parents;

use Illuminate\Support\Facades\Facade;

class ParentsFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'parents';
    }
}