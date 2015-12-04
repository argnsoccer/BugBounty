<?php
$app->get('/_hunter/signup', function() use ($app) {
		$app->render('/_hunter/signup.php');
});

$app->get('/_marshal/signup', function() use ($app) {
		$app->render('/_marshall/signup.php');
});
?>
