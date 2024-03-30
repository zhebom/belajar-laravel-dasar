<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class EnvironmentTest extends TestCase
{
    
    public function testGetEnv()
    {
      $youtube = env('YOUTUBE');
      self::assertEquals('Programmer Zaman Now', $youtube);
    }

    public function testDefaultEnv()
    {
      $author = env('AUTHOR', 'Eko');
      self::assertEquals('Eko', $author);
    }
}
