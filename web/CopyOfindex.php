<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use CodeCafe\Utils;
use CodeCafe\Controller\LeapYearController;
use CodeCafe\Application;


$request = Request::createFromGlobals();
$response = new Response();

try {
	
	$application = new CodeCafe\Application();
	$response = $application->handle($request);
	
	/*
	$view_config['view_folder'] = __DIR__.'/../src/pages/';
	$view = new Utils\View($view_config);
	
	$response = $view->render($request);
	*/
	//echo $response; exit;
	//echo "<pre>"; print_r($response); echo "</pre>"; exit;
	/*	
		//extract($attributes);
		ob_start();
			require_once __DIR__."/../src/pages/$_route.php";
		$content = ob_get_clean();
		
		$response->setContent($content);
	*/	
	
}catch (Routing\Exception\ResourceNotFoundException $e){
	
	$response->setStatusCode(404);
	$response->setContent($e->getMessage());
}/* catch (Exception $e){
	$response->setStatusCode(404);
	$response->setContent($e->getMessage());
} */


$response->send();
