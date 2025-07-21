<?php

namespace ProactiveAnts\Discipline\Test;

use ProactiveAnts\Discipline\DisciplineFacade;
use ProactiveAnts\Discipline\DisciplineServiceProvider;
use Ochestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app){
        return [DisciplineServiceProvider::class];
    }

    protected function getPackageAliases($app){
        return ['Discipline' => DisciplineFacade::class];
    }


}