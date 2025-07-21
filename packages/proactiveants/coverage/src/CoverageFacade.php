<?php

namespace ProactiveAnts\Coverage;

use Illuminate\Support\Facades\Facade;

class CoverageFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'coverage';
    }
}