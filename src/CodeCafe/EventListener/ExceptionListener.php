<?php

namespace CodeCafe\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionListener implements EventSubscriberInterface {
	
	public function onKernelException($event){
	
		$response = new Response("<h1 style='font-color: red;'> Sorry there was some error encountered while processing the request.</h1>");
		$event->setResponse($response);
	
	}
	
	public static function getSubscribedEvents() {
		return array(
				KernelEvents::EXCEPTION => array('onKernelException', -128),
		);
	}
	
}

