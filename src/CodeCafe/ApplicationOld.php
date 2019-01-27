<?php

namespace CodeCafe;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\EventDispatcher\EventDispatcher;
use CodeCafe\Event\ResponseEvent;
use CodeCafe\EventListener\ExceptionListener;

class ApplicationOld extends HttpKernel {
	
	protected $matcher;
	protected $resolver;
	
	public function __construct()
	{
		$routes = AppRoutes::getRoutes();
		
		$context = new Routing\RequestContext();
		$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
		$resolver = new ControllerResolver();
		$this->dispatcher = new EventDispatcher();
		$this->matcher = $matcher;
		$this->resolver = $resolver;
		
		parent::__construct($this->dispatcher, $resolver);
		
		$this->registerListeners();
	}
	
	public function handle_d(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
	{
		$this->matcher->getContext()->fromRequest($request);
	
		try {
			$request->attributes->add($this->matcher->match($request->getPathInfo()));
	
			$controller = $this->resolver->getController($request);
			$arguments = $this->resolver->getArguments($request, $controller);
	
			$response = call_user_func_array($controller, $arguments);
		} catch (ResourceNotFoundException $e) {
			$response = new Response('Not Found', 404);
		} catch (\Exception $e) {
			$response = new Response('An error occurred', 500);
			throw $e;
		}
		
		$this->dispatcher->dispatch('response', new ResponseEvent($response, $request));
		
		return $response;
		
	}
	
	private function registerListeners(){
		
		$this->dispatcher->addSubscriber(new ExceptionListener());
	}
}

