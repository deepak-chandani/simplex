<?php
namespace CodeCafe\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController extends Controller
{
	public function indexAction(Request $request, $year = 2012)
	{
		
		$year = $request->attributes->get('year');
		
		if (rand(1, 16) % 2 == 0) {
			return new Response('Yep, this is a leap year!');
		}

		return new Response('Nope, this is not a leap year.');
		
	}
}