<?php

namespace CodeCafe\Controller;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class Controller implements ContainerAwareInterface {
	
	protected  $container;
	
	public function setContainer(ContainerInterface $container = null) {
		
		$this->container = $container;
	}
	
	public function render($file, $vars){
		
		$templating = $this->container->get('template.engine');
		
		$content = $templating->render($file, $vars);
		
		return new Response($content);
	}
}

