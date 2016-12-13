<?php

if ( !function_exists( 'githubapi' ) ) {
    function githubapi()
    {
        return app( 'githubapi' );
    }
}

if ( !function_exists( 'weather' ) ) {
    function weather()
    {
        return app( 'weather' );
    }
}
