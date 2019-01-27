<?php

namespace CodeCafe;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Routing\Route;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Routing\RouteCollection;

class AppRoutes {
	
	public static function setRoutes(RouteCollection $routes){
		
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
		
	}
	
	public static function setRoutes_dd(RouteCollection $routes){
		
		$arr = Yaml::parse(file_get_contents(__DIR__.'/config/routes.yml'));
		//echo "<pre>"; print_r($arr); echo "</pre>"; exit;
		echo "<pre>"; var_dump($arr); exit;
		
		foreach ($arr as $k => $params){
			
			//$a = array('key' => $k, 'path' => $params['path'], 'defaults' => $params['defaults']);

			//echo "<pre>"; print_r($a); echo "</pre>"; 
			$routes->add($k, new Route($params['path'], $params['defaults']));
		}

		//echo "<br> routes collection";
		
		//echo "<pre>"; print_r($routes); echo "</pre>"; exit;
		
	}
	
}

