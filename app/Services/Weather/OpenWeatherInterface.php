<?php
/**
 * Created by PhpStorm.
 * User: Chris
 * Date: 9/20/2017
 * Time: 8:16 AM
 */

namespace App\Services\Weather;
use GuzzleHttp\Client;

class OpenWeatherInterface
{
    public function GetWeatherInfo($zipCode){
        $appId = config('app.weather_api_key', '');
        if(!empty($appId)){
            $client = new Client();

            $response = $client->get("https://api.openweathermap.org/data/2.5/weather?appid={$appId}&zip={$zipCode},us&units=imperial", [
                'verify' => false,

            ]);
            $obj = \GuzzleHttp\json_decode($response->getBody());
            return $obj;
        }
        else{
            return false;
        }
    }
}