<?php

namespace Tests\Feature;

use App\Services\Weather\OpenWeatherInterface;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WeatherTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $weatherInterface = new OpenWeatherInterface();
        $response = $weatherInterface->GetWeatherInfo(34286);

        echo print_r($response, true);
        $this->assertTrue($response !== false);
        $this->assertTrue(strtolower($response->name) == 'north port');
    }
}
