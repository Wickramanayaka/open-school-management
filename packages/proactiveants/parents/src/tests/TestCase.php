<?php

namespace ProactiveAnts\Coverage\Test;

use ProactiveAnts\Coverage\CoverageFacade;
use ProactiveAnts\Coverage\CoverageServiceProvider;
use Ochestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app){
        return [CoverageServiceProvider::class];
    }

    protected function getPackageAliases($app){
        return ['Coverage' => CoverageFacade::class];
    }


}