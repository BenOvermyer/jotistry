<?php

class TestBasic extends TestCase
{
    public function testLoginView()
    {
        $this->visit( '/' )
            ->see( 'Log In' );
    }
}
