<?php

namespace CodeCafe\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel;


class ControllerResolver extends HttpKernel\Controller\ControllerResolver {
	
	private $container;
	
	public function __construct($container, $logger = null){

		parent::__construct($logger);
		$this->container = $container;
		
	}
	
	public function getController(Request $request){
		
		$controller = parent::getController($request);
		//echo "<pre>"; print_r($controller); echo "</pre>"; exit;
		
		if(is_array($controller)){
			
			$obj = $controller[0];
			
			$obj->setContainer($this->container);
		}
		
		return $controller;
	}
	
}

