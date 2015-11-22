<?php

session_start();

require '../vendor/autoload.php';

$app = new \Slim\Slim([
	'view' => new \Slim\Views\Twig()
]);

$dbname = 'bug_bounty_test';
$user = 'bugUser';
$pass = '3.00x10^8m/s';
$host = '52.88.178.244';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('hpbqp357jtm2v6kt');
Braintree_Configuration::publicKey('k86rsvssx8f2w564');
Braintree_Configuration::privateKey('9c4a739428d609d7973f5002a5c67d40');

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
