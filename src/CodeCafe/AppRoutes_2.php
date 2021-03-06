<?php

namespace CodeCafe;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class AppRoutes_2 {
	
	public static function configure(){
		
	}
	
	public static function getRoutes(){

		$routes = new RouteCollection();
		
		$routes->add('hello', new Route('/hello/{name}', array(
				'name'=> 'Worldd',
				'new_param'=> 'newparam',
				'_controller'=> 'CodeCafe\\Controller\\HelloController::indexAction',
		)));
		
		$routes->add('is_leap_year', new Route('/is_leap_year/{year}', array(
				'year'=> 2015,
				'_controller'=> 'CodeCafe\\Controller\\LeapYearController::indexAction',
		)));
		$routes->add('bye', new Route('/bye'));
		
		/*
		 $routes->add('leapyear', new Route('/leapyear/{year}'), array(
		 		'year' => 2012,
		 		'yeardr' => 2012,
		 		'_controller' => 'CodeCafe\\Controller\\LeapYearController::indexAction'
		 ));*/
		
		return $routes;
		
	}
}

?>