<?php

namespace Website;

use Symfony\Component\Templating\Loader\FilesystemLoader;
use CodeCafe\Application;

class WebsiteApp extends Application {
	
	public function __construct($environment){
		
		parent::__construct($environment);
		
		
		// override the loader
		//$loader = new FilesystemLoader(__DIR__.'/views/%name%');
		//$this->container->setParameter('template.loader', $loader);
		
		// set configuration related parameters based on environment we are running
		
		
		// set routes 
		WebsiteRoutes::setRoutes($this->container->get('routes'));
		
		// register services if required by website app
	}
	
	protected function getFileSystemLoader(){
	
		$loader = new FilesystemLoader(__DIR__.'/views/%name%');
	
		return $loader;
	}
}

