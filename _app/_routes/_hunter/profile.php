<?php

session_start();
session_set_cookie_params(0);

function prepareHunterProfile($dbh, $username) {
	// for the hunter profile page, we need
	// 	1)  the username
	// 	2)  the email
	// 	3)  the path to the profile picture
	// 	4)  all the reports this user has ever submitted
	// 		(paid and non-paid) (all info including bountyID)
		
	if ($username === $_SESSION['userLogin'] 
		&& $_SESSION['userType'] === 'hunter')
	{
		$args[':username'] = $username;

		$template_array['user'] = getUserFromUsername($dbh, $args);

		$dummy_reports = getNumberReportsFiled($dbh, $args);

		$template_array['user']['numReportsFiled'] = $dummy_reports['numberOfReports'];

		$dummy_reports = getNumberReportsApproved($dbh, $args);

		$template_array['user']['numReportsApproved'] = $dummy_reports['numberOfReports'];

		$template_array['error'] = 0; //for time being

		$template_array['recentBounties'] = array( //GET ALL BOUNTIES FROM HUNTER ACCOUNT
			array(
				"name" => "name1",
				"bountyID" => "001",
				"company" => "Microsoft",
				"accountID" => "001"
			),
			array(
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002"
			),
			array(
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002"
			),
			array(
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002"
			),
			array(
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002"
			),
			array(
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002"
			),
			array(
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002"
			),
			array(
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002"
			),
			array(
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002"
			),
			array(
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002"
			),
			array(
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002"
			),
			array(
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002"
			)
		);

		$template_array['recentReports'] = array(
			array(
				"date" => "2012/12/05",
				"name" => "name1",
				"bountyID" => "001",
				"company" => "Microsoft",
				"accountID" => "001",
				"amountPaid" => "100.00",
				"message" => "Great find!",
				"reportID" => "0001"
			),
			array(
				"date" => "2012/12/05",
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002",
				"amountPaid" => "0.00",
				"message" => "eh not an error",
				"reportID" => "0002"
			),
			array(
				"date" => "2012/12/05",
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002",
				"amountPaid" => "0.00",
				"message" => "eh not an error",
				"reportID" => "0002"
			),
			array(
				"date" => "2012/12/05",
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002",
				"amountPaid" => "0.00",
				"message" => "eh not an error",
				"reportID" => "0002"
			),
			array(
				"date" => "2012/12/05",
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002",
				"amountPaid" => "0.00",
				"message" => "eh not an error",
				"reportID" => "0002"
			),
			array(
				"date" => "2012/12/05",
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002",
				"amountPaid" => "0.00",
				"message" => "eh not an error",
				"reportID" => "0002"
			),
			array(
				"date" => "2012/12/05",
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002",
				"amountPaid" => "0.00",
				"message" => "eh not an error",
				"reportID" => "0002"
			),
			array(
				"date" => "2012/12/05",
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002",
				"amountPaid" => "0.00",
				"message" => "eh not an error",
				"reportID" => "0002"
			),
			array(
				"date" => "2012/12/05",
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002",
				"amountPaid" => "0.00",
				"message" => "eh not an error",
				"reportID" => "0002"
			),
			array(
				"date" => "2012/12/05",
				"name" => "name2",
				"bountyID" => "001",
				"company" => "Apple",
				"accountID" => "002",
				"amountPaid" => "0.00",
				"message" => "eh not an error",
				"reportID" => "0002"
			),
		);

		return $template_array;
	}
	else
	{

	}
	
}

$app->get('/_hunter/profile', function() use ($app) {
	echo "include a username";
	//$app->render('_profiles/');
});

$app->get('/_hunter/profile/:username', function($username) use ($app, $dbh) {

	$template_array = prepareHunterProfile($dbh, $username);

	if (isset($_SESSION['userLogin'])
		&& isset($template_array['error'])
		&& $template_array['error'] === 0)
	{
			$app->render('_hunter/profile.php', $template_array);
			// echo print_r($template_array);
	}
	else 
	{
		if ($template_array['error'] === 1)
		{
			echo "error - No username is database with passed username";
		}
		else if ($template_array['error'] === 2)
		{
			echo "error - statement was not ran";
		}
		else 
		{
			echo "error - no error code returned";
		}
	}
});
