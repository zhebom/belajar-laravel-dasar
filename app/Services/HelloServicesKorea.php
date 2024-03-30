<?php 
namespace App\Services;

class HelloServicesKorea implements HelloServices
{
    public function hello(string $name):  string {
        return "hallo $name";
        
    }
}