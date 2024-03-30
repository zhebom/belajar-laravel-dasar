<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
   
    public function testConfig()
    {
       $firstName = config('contoh.author.first');
       $lastName = config('contoh.author.last');
       $web = config('contoh.web');
       $email = config('contoh.email');

       self::assertEquals($firstName, "Eko");
       self::assertEquals($lastName, "Widhi");
       self::assertEquals($web, "https://feb.upstegal.ac.id");
       self::assertEquals($email, "zhebom@gmail.com");
    
    }
}