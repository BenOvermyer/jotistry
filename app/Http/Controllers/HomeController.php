<?php

namespace App\Http\Controllers;

class HomeController extends Controller {
	public function index() {
		return view( 'home.index', [ 'pageTitle' => 'Home' ] );
	}
    
    public function dashboard() {
        return view( 'home.dashboard', [ 'pageTitle' => 'Dashboard' ] );
    }
}