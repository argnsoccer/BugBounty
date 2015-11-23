<?php

session_start();

require '../vendor/autoload.php';

$app = new \Slim\Slim([
	'view' => new \Slim\Views\Twig()
]);

$dbname = 'bug_bounty_test';
$user = 'bugUser';
$pass = '3.00x10^8m/s';
$host = '54.88.178.244';

try {
  $dbh = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$pass");
}
catch (PDOException $e) {
    $response = "Failed to connect: ";
    $response .= $e->getMessage();
    die ($response);
}

$view = $app->view();
$view->setTemplatesDirectory('../_app/_views');
$view->parserExtensions = [
	new \Slim\Views\TwigExtension()
];

require 'routes.php';
