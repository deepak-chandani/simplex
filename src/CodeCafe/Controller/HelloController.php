<?php
namespace CodeCafe\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends Controller
{
	public function indexAction(Request $request, $name)
	{
		
		$templating = $this->container->get('template.engine');
		
		//return new Response("<h1> Hello $name <br> </h1>");
		
		return $this->render('hello.php', array('firstname' => 'Fabien'));
		
	}
}