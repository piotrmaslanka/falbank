<?php
	$suppress_login_check = true;
	include_once('includes/bootstrap.php');
	
	
	$taplr = new TAPLReader('templates/logging.tpl');
	$temp = $taplr->mkTemplate('login');
	
	
	if (!empty($_POST['user']) || !empty($_POST['pass']))
	{
		$usr = new APIUser();
		if (!$usr->createByLogin($_POST['user'], $_POST['pass']))
		{
			$temp->setText('action','baduser');
		} else
		{
			$usr->loadRegistry();
			$_SESSION['usrid'] = $usr->id;
			$_SESSION['logged'] = true;
			$usr->registry['Falbank']['Database'] = 'dms_falbank';
			// TODO: License check
			APISession::loginUser($usr);
			Location('index.php');
		}
	}
	
	echo($temp->render());
?>
