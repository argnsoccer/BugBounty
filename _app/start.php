<?php

session_start();

require '../vendor/autoload.php';

$app = new \Slim\Slim([
	'view' => new \Slim\Views\Twig()
]);

//Database
// $app->container->singleton('db', function() {
// 	return new PDO('mysql:host=52.88.178.244;db=BugBounty', 
// 		'testuser', 'cse3345bugbountypass');
//});

$view = $app->view();
$view->setTemplatesDirectory('../_app/_views');
$view->parserExtensions = [
	new \Slim\Views\TwigExtension()
];

require 'routes.php';