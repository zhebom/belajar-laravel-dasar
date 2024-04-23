<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloServices as ServicesHelloServices;
use App\Services\HelloServicesIndonesia;
use App\Services\HelloServicesKorea;
use HelloServices;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ServiceContainerTest extends TestCase
{

    public function testDependencyInjection()
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertSame($foo, $foo2);
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person);

        $this->app->bind(Person::class, function($app){
            return new Person ("Eko", "Khannedy");
        });
        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Eko', $person1->firstname);
        self::assertEquals('Eko', $person2->firstname);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person);

        $this->app->singleton(Person::class, function($app){
            return new Person ("Eko", "Khannedy");
        });
        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Eko', $person1->firstname);
        self::assertEquals('Eko', $person2->firstname);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person);
        $person = new Person ("Eko", "Khannedy");
        $this->app->instance(Person::class, $person);
          
        
        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Eko', $person1->firstname);
        self::assertEquals('Eko', $person2->firstname);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection2()
    {
      $foo = $this->app->make(Foo::class);
      $bar = $this->app->make(Bar::class);

      self::assertSame($foo, $bar->foo);
    }

    public function testDependencyInjection3()
    {
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });
      $foo = $this->app->make(Foo::class);
      $bar = $this->app->make(Bar::class);

      self::assertSame($foo, $bar->foo);
    }


    public function testDependencyInClosur()
    {
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });
        $this->app->singleton(Bar::class, function($app){
            $foo =$app->make(Foo::class);
            return new Bar($foo);
        });
      $foo = $this->app->make(Foo::class);
      $bar2 = $this->app->make(Bar::class);
      $bar1 = $this->app->make(Bar::class);

      //self::assertSame($foo, $bar1->foo);
      self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
     // $this->app->singleton(ServicesHelloServices::class, HelloServicesKorea::class);
     $this->app->singleton(ServicesHelloServices::class, function ($app) {
        return new HelloServicesKorea();
     });
      $helloService = $this->app->make(ServicesHelloServices::class) ;
      self::assertEquals('hallo Eko', $helloService->hello('Eko'));
    }
}
