<?php

namespace CodeCafe;

use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

use CodeCafe\Application\Environments;
use CodeCafe\EventListener\ExceptionListener;
use CodeCafe\Controller\ControllerResolver;
use CodeCafe\AppRoutes;


class Application extends HttpKernel {
	
	public $container;
	
	public function __construct($environment){
		
		$container = new DependencyInjection\ContainerBuilder();
		$this->container = $container;
		
		
		$container->setParameter('environment', $environment);
		$container->setParameter('name', 'name');
		
		$container->register('routes', 'Symfony\Component\Routing\RouteCollection');
		AppRoutes::setRoutes($container->get('routes'));
		
		$container->register('context', 'Symfony\Component\Routing\RequestContext');
		$container->register('matcher', 'Symfony\Component\Routing\Matcher\UrlMatcher')
					->setArguments(array(new Reference('routes'), new Reference('context')));
		
		$container->register('resolver', 'CodeCafe\Controller\ControllerResolver')
					->setArguments(array($this->container, null));
		
		
		//$container->register('resolver', 'Symfony\Component\HttpKernel\Controller\ControllerResolver');
		$container->register('requestStack', 'Symfony\Component\HttpFoundation\RequestStack');
			
		// register definitions for listeners
		$container->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')
			 	->setArguments(array(new Reference('matcher'), new Reference('requestStack')));
		
		// register dispatcher
		$container->register('dispatcher', 'Symfony\Component\EventDispatcher\EventDispatcher')
				->addMethodCall('addSubscriber', array(new Reference('listener.router')));
		
		//echo "<pre>"; print_r(__DIR__); echo "</pre>"; exit;
		
		// register templating component
		$loader = $this->getFileSystemLoader();
		$container->setParameter('template.loader', $loader);
		//$container->register('template.loader', 'Symfony\Component\Templating\Loader\FilesystemLoader')
			//		->setArguments(array('C:\xampp\htdocs\simplex\src\CodeCafe'.'\\views\\%name%'));
		
		$container->register('template.parser', 'Symfony\Component\Templating\TemplateNameParser');
		
		$container->register('template.engine', 'Symfony\Component\Templating\PhpEngine')
					->setArguments(array(new Reference('template.parser'), $container->getParameter('template.loader')));
		
		parent::__construct($this->get('dispatcher'), $this->get('resolver'), $this->get('requestStack'));
		
		$this->registerListeners();
	}
	
	protected function getFileSystemLoader(){
		
		$loader = new FilesystemLoader(__DIR__.'/views/%name%');
		
		return $loader;
	}
	
	public function get($key){
		return $this->container->get($key);
	}
	
	private function registerListeners(){
	
		$environment = $this->container->getParameter('environment');
		
		if($environment == Environments::PRODUCTION){
			
		  $this->get('dispatcher')->addSubscriber(new ExceptionListener());
		}else{
			
			Debug::enable();
			ErrorHandler::register();
			ExceptionHandler::register();
		}
		
	}
	
	public function run(Request $request = null){
		
		if($request == null){
			$request = Request::createFromGlobals();
		}
		
		
		$response = $this->handle($request);
		$response->send();
		
		$this->terminate($request, $response);
	}
}

