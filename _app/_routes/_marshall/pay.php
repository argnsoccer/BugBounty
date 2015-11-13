
<?php

session_start();
session_set_cookie_params(0);

function preparePayPage($dbh) {
	$template_array = array();
	$template_array["reports"] = array(
		array(
			'bountyID' => '001',
			'username' => 'testHunter1',
			'description' => 'Fuck bitches; get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.',
			'dateSubmitted' => '11/11/2015',
			'link' => 'meatspin.com',
			'pathToError' => 'The spin counter does not increase beyond 1073741823',
			'filePath' => 'testPath',
			'errorName' => 'This shit is fucked, yo',
			'reportID' => '69105'
		),
		array(
			'bountyID' => '002',
			'username' => 'testHunter1',
			'description' => 'Fuck bitches; get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.',
			'dateSubmitted' => '11/11/2015',
			'link' => 'meatspin.com',
			'pathToError' => 'The spin counter does not increase beyond 1073741823',
			'filePath' => 'testPath',
			'errorName' => 'This shit is fucked, yo',
			'reportID' => '69'
		),
		array(
			'bountyID' => '007',
			'username' => 'testHunter1',
			'description' => 'Fuck bitches; get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.Fuck bitches get money. I got so many keys, people think I be valet parking.',
			'dateSubmitted' => '11/11/2015',
			'link' => 'meatspin.com',
			'pathToError' => 'The spin counter does not increase beyond 1073741823',
			'filePath' => 'testPath',
			'errorName' => 'This shit is fucked, yo',
			'reportID' => '96'
		)
	);

	return $template_array;
}
	//for the Pay Page
	// 1)  all reports the user had identified to pay

$app->get('/_marshall/pay', function($bounty_id) use ($app, $dbh) {
	$template_array = preparePayPage($dbh);
	$app->render('_marshall/pay.php', $template_array);
});
