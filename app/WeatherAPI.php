<?php namespace App;

use Cache;
use Config;

class WeatherAPI
{
    public function current( $state, $city )
    {
        $weather = Cache::get( "weather.$state.$city" );

        return $weather;
    }
}
