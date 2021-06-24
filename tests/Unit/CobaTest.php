<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CobaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testAdala()
    {
        $expected = new \stdClass();
        $expected->foo = 'foo';
        $expected->bar = 'bar';
    
        $actual = new \stdClass();
        $actual->foo = 'foo';
        $actual->bar = 'bar';
        $this->assertEquals($expected, $actual);
    }
}
