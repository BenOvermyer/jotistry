<?php

namespace App\Console\Commands;

use App\User;
use Cache;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class CacheWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the weather cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info( 'Fetching weather data...' );

        $key = config( 'services.weather_underground.api_key' );

        $client = new Client();

        $users = User::all();

        foreach ( $users as $user ) {
            $state = $user->state;
            $city = $user->city;

            $response = $client->request( 'GET', 'http://api.wunderground.com/api/' . $key . "/conditions/q/$state/$city.json" );

            if ( 200 != $response->getStatusCode() ) {
                continue;
            }

            $data = json_decode( $response->getBody() );

            $this->info( "Caching weather for $city, $state..." );

            Cache::forever( "weather.$state.$city", $data );
        }
    }
}
