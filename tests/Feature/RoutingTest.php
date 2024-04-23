<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText("Hello Programmer Zaman Now");
    }

    public function testRedirect()
    {
        $this->get('youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/pznn')
            ->assertSeeText('404 by Programmer Zaman Now');
    }
}
