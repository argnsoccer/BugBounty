<?php

session_start();

function remove_magic_quotes($array) {
    foreach ($array as $k => $v) {
        if (is_array($v)) {
            $array[$k] = remove_magic_quotes($v);
        } else {
            $array[$k] = stripslashes($v);
        }
    }
    return $array;
}

require '../vendor/autoload.php';

$app = new \Slim\Slim([
	'view' => new \Slim\Views\Twig()
]);

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('hpbqp357jtm2v6kt');
Braintree_Configuration::publicKey('k86rsvssx8f2w564');
Braintree_Configuration::privateKey('9c4a739428d609d7973f5002a5c67d40');

$dbname = 'bug_bounty_test';
$user = 'bugUser';
$pass = '3.00x10^8m/s';
$host = '52.88.178.244'

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

if (get_magic_quotes_gpc()) {
    $_GET    = remove_magic_quotes($_GET);
    $_POST   = remove_magic_quotes($_POST);
    $_COOKIE = remove_magic_quotes($_COOKIE);
}

require 'routes.php';
