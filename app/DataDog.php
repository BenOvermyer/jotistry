<?php namespace App;

use Datadogstatsd;

class DataDog
{
    public function inc( $metric )
    {
        Datadogstatsd::increment( "jotistry.$metric" );
    }

    public function dec( $metric )
    {
        Datadogstatsd::decrement( "jotistry.$metric" );
    }

    public function gauge( $metric, $amount )
    {
        Datadogstatsd::gauge( "jotistry.$metric", $amount );
    }

    public function set( $metric, $amount )
    {
        Datadogstatsd::set( "jotistry.$metric", $amount );
    }

    public function time( $metric, $duration )
    {
        Datadogstatsd::timing( "jotistry.$metric", $duration );
    }

    public function error( $name, $text )
    {
        Datadogstatsd::event( $name, [
            'text' => $text,
            'alert_type' => 'error',
            'tags' => [ 'application:jotistry' ]
        ] );
    }

    public function info( $name, $text )
    {
        Datadogstatsd::event( $name, [
            'text' => $text,
            'alert_type' => 'info',
            'tags' => [ 'application:jotistry' ]
        ] );
    }

    public function warn( $name, $text )
    {
        Datadogstatsd::event( $name, [
            'text' => $text,
            'alert_type' => 'warning',
            'tags' => [ 'application:jotistry' ]
        ] );
    }

    public function success( $name, $text )
    {
        Datadogstatsd::event( $name, [
            'text' => $text,
            'alert_type' => 'success',
            'tags' => [ 'application:jotistry' ]
        ] );
    }
}
