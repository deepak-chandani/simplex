<?php

namespace CodeCafe\Utils;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class View {

	private $configs = array(
			
	);
	protected $request;
	
	public function __construct(array $config = array()){

		$this->configs['view_folder'] = __DIR__.'/../pages/';
		
		$this->configs = array_merge($this->configs, $config);
	}
	
	public function render(Request $request){
		
		$this->request = $request;
		
		$attributes = $this->request->attributes->all();
		
		extract($attributes);
		
		ob_start();
			require_once $this->configs['view_folder']."$_route.php";
			
		return new Response(ob_get_clean());	
	}
}

