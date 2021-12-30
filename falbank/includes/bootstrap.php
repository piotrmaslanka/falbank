<?php
	ini_set('display_errors',0);
	error_reporting(E_ALL - E_NOTICE);

	include_once('../techplatform/libtechplatform.php');
	
	header("Content-Type: text/html; charset=utf-8");
	
	APISession::start();
	

	if (!($suppress_login_check === true))
	{
		if (!APISession::isLogged()) Location('login.php');
		$usr = new APIUser();
		$usr->createForceId($_SESSION['usrid']);
		$usr->loadRegistry();
		$_SESSION['user'] = $usr;	
	}
	
	$conf = new APIConfig();
	$conf->load('config.ini');
	
	$stusr = new APIUser($db);
	
	$db = new APIDatabase($conf->config['MySQL']['host'],
						  $conf->config['MySQL']['user'],
						  $conf->config['MySQL']['pass']);
	$db->connect();
	
	$db->selectDatabase('dms_falbank');
	
		include_once('classes/db_zgloszenia.php');
		include_once('classes/db_parts.php');
		include_once('classes/db_uruchomienia.php');
		
		include_once('classes/partprocessor.php');
		
		include_once('processes/add_parts.php');
		include_once('processes/chk_add_parts.php');
		include_once('processes/chk_zgloszenia.php');
		include_once('processes/zgloszenia.php');
		include_once('processes/chk_transform.php');
		include_once('processes/transform.php');
		include_once('processes/chk_orders_parts.php');
		include_once('processes/orders_parts.php');
		include_once('processes/arr_parts.php');
		include_once('processes/chk_arr_parts.php');
		include_once('processes/chk_send.php');
		include_once('processes/send.php');
		include_once('processes/uruchomienie.php');
		include_once('processes/chk_uruchomienie.php');
		
		include_once('filters/filter_crew.php');
	
?>
