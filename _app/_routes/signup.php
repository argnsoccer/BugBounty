<?php
$app->get('/signup', function() use ($app) {
		$app->render('/_hunter/signup.php');
});
?>
