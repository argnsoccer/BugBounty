<?php

session_start();
session_set_cookie_params(0);

function getUserNameDetailsMarshall($dbh, $username)
{
	$statement = $dbh->prepare("
				SELECT *
				FROM Account, Marshall
				WHERE username.Account = :username AND accountType.Account = 'marshall' ");

	$args[':username'] = $username;

	if($statement->execute($args)) {
		$row = $statement->fetch(PDO::FETCH_ASSOC);

    if (isset($row['username'])) {
    	$template_array = array(
    		"username" => $row['username'],
    		"email" => $row['email'],
    		"error" => 0,
    		"imageLoc" => $row['imageLoc'],
				"description" => $row['description'],
				"company" => $row['company']
				//paid bounties
				//current bounties
    	);
			$statement = $dbh->prepare("
			SELECT *
			FROM Marshall, BountyPool
			WHERE marshallID.Marshall = bountyMarshallID.BountyPool");

			if($statement->execute()){
				$row = $statement->fetch(PDO::FETCH_ASSOC);
				if($row['dateEnded'] < now())
				{
					$template_array['currentBountiesLink'] = $row['bountyLink'];
					$template_array['currentBountyDescription'] = $row['fullDescription'];
				}
				else if ($row['Paid'] == true){
					$template_array['paidBounties'] = $row['bountyLink'];
					$template_array['paidBountyLineDescription'] = $row['lineDescription'];
				}
			}
			else{
				$template_array['error'] = 3;
				$template_array['message'] = 'Second statement not run';
			}
    }
    else {
    	$template_array = array(
    		"error" => 1,
    		"message" => 'No username',
    	);
    }

	}
	else {
		$template_array = array(
    		"error" => 2,
    		"message" => 'Statement not ran',
    	);
	}

	return $template_array;
}

$app->get('/_marshall/profile', function() use ($app) {
	echo "include a username";
	//$app->render('_profiles/');
});

$app->get('/_marshall/profile/:username', function($username) use ($app, $dbh) {
	//echo $username;

	if (isset($_SESSION['userLogin']))
	{
		$template_array = getUserNameDetailsMarshall($dbh, $username);

		if($template_array['error'] == 0)
		{
			$app->render('_marshall/profile.php', $template_array);
		}
		else if ($template_array['error'] == 1)
		{
			echo "error - No username is database with passed username";
		}
		else if ($template_array['error'] == 1)
		{
			echo "error - statement was not ran";
		}
	}
});
