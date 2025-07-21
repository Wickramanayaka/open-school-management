<?php

namespace ProactiveAnts\Discipline\Test;

use ProactiveAnts\Discipline\Discipline;

class DisciplineTest extends TestCase
{
    public function testAddition()
    {
        $result = Discipline::add(17,3);
        $this->assertEquals(20,$result);
    }
}