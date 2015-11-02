<?php

function preparteSearchPage() {
	//nothing as of yet
}

$app->get('/_hunter/search', function() use ($app) {

	$template_array = array("username" => "test");

	$app->render('_hunter/search.php', $template_array);

});