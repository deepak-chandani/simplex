<?php

namespace CodeCafe\Event;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\Event;

class ResponseEvent extends Event {
	
	private $request;
	private $response;
	
	
	public function __construct($res, $req){
		$this->response = $res;
		$this->request = $req;
	}
	
	
	public function getResponse(){
		return $this->response;
	}
	
	public function getRequest(){
		return $this->request;
	}
	
	
}

