<?php
$app->get('/billinginfo', function() use ($app) {
		$app->render('/_hunter/billinginfo.php');
});
?>
