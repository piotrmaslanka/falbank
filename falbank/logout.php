<?php
 	include_once('includes/bootstrap.php');
	
	APISession::logoutUser();
	
	unset($_SESSION['logged']);
	unset($_SESSION['usrid']);
	unset($_SESSION['user']);

	$taplr = new TAPLReader('templates/logging.tpl');
	$temp = $taplr->mkTemplate('logout');
		
	echo($temp->render());
?>
