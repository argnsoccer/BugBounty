<?php

//session_destroy();
if(!isset($_SESSION))
{
  session_start(); 
}
session_set_cookie_params(0);
//$_SESSION['userLogin'] = "mgilbert";
//$_SESSION['userType'] = "hunter";

//need the example bounties
//make a new table and call it Preferred Bounties
//store 9 different example bounties that exist inside the database

function prepareHome(){

	//return 9 bounties from Preferred Bounties
}

function prepareHunterHome(){

	//return 9 bounties from Preferred Bounties
	//return username
	//return active Bounties (haven't been paid for)
	//return profile pic path
}

function prepareMarshallHome(){

	//return username
	//return current bounties
	//return profile picture path
}

$app->get('/', function() use ($app) {

	if (isset($_SESSION['userLogin']))
	{
		if ($_SESSION['userType'] == 'hunter')
		{
				//call prepare hunter home
			$app->render('/_hunter/home.php',
				array('username' => $_SESSION['userLogin']));
		}
		else if ($_SESSION['userType'] == 'marshall' || $_SESSION['userType'] == 'sheriff')
		{
			//call prepare marshall home
			$app->render('/_marshall/home.php',
				array('username' => $_SESSION['userLogin']));
		}
		else
		{
			echo "account type not specified";
		}
	}
	else
	{
		//call prepare home
		$app->render('home.php');
	}
});
