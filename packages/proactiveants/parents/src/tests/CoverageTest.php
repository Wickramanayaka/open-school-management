<?php

namespace ProactiveAnts\Coverage\Test;

use ProactiveAnts\Coverage\Coverage;

class CoverageTest extends TestCase
{
    public function testAddition()
    {
        $result = Coverage::add(17,3);
        $this->assertEquals(20,$result);
    }
}