<?php

function prepareUploadPage($dbh) {
	
}

$app->get('/_marshall/upload', function() use ($app) {
	$app->render('_marshall/upload.php');
});