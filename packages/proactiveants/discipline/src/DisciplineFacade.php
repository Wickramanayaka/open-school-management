<?php

namespace ProactiveAnts\Discipline;

use Illuminate\Support\Facades\Facade;

class DisciplineFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'discipline';
    }
}