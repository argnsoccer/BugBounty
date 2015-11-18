<?php
$app->get('/signup', function() use ($app) {
		$app->render('signup.php');
});
?>
