<?php

	session_start();
	require("../../FBSDK/facebook.php");

	$facebook = new Facebook(array(
			'appId' => '665731016889765',
			'secret' => '87d71c049964c37fb5d3d18ad9886ffe',
			'cookie' => true
		));

	$session = $facebook->getUser();

	if(!empty($session))
	{
		// facebook session is active
		try
		{
			$uid = $facebook->getUser();
			$user = $facebook->api('/me');
		}
		catch(Exception $e){}

		if(!empty($user))
		{
			$_SESSION['registerdata'] = $user;
			header('Location:../facebooklogin');//redirect ke halaman facebook controllers
			// //print_r($user);
		}
		else
		{
			// problem.
			die("Terjadi masalah, silahkan tekan \"F5\" untuk refresh halaman");
		}
	}
	else
	{
		// no active facebook session
		$login_url = $facebook->getLoginUrl();
		header("Location: " . $login_url);
	}

?>