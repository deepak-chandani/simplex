<?php
require_once __DIR__.'/../vendor/autoload.php';

use CodeCafe\Application;
use CodeCafe\Application\Environments;

	$application = new CodeCafe\Application(Environments::DEVELOPMENT);
	$application->run();
	
