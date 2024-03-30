<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class AppEnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAppEnv()
    {
       if(App::environment('testing')){
        self::assertTrue(true);
       }
    }
}
