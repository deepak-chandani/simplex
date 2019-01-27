<?php
require_once __DIR__.'/../vendor/autoload.php';

use Website\WebsiteApp;
use CodeCafe\Application\Environments;

	$application = new WebsiteApp(Environments::DEVELOPMENT);
	$application->run();