
<?php

session_start();
session_set_cookie_params(0);

function preparePayPage($dbh) {

	$template_array['username'] = $_SESSION['userLogin'];

	$args[':username'] = $_SESSION['userLogin'];

	$template_array['submittedReports'] = getReportsFromMarshal($dbh, $args);

	$template_array['bounties'] = [];


	foreach ($template_array['submittedReports']['result'] as $report) {

		if(!in_array($report['bountyName'], $template_array['bounties'] )) {
			array_push($template_array['bounties'], $report['bountyName']);
		}
	}

	return $template_array;
}
	//for the Pay Page
	// 1)  all reports the user had identified to pay

$app->get('/_marshal/pay', function() use ($app, $dbh) {

	$template_array = preparePayPage($dbh);
	$app->render('_marshall/pay.php', $template_array);

	echo print_r($template_array);
});
