<?php
	include_once('includes/bootstrap.php');
	
	$taplr = new TAPLReader('templates/settings.tpl');
	$temp = $taplr->mkTemplate('index');
	
	if (isset($_POST['ok']))
	{
		$usr->registry['Falbank']['Settings']['smtphostname'] = $_POST['smtphostname'];
		$usr->registry['Falbank']['Settings']['smtpusername'] = $_POST['smtpusername'];
		$usr->registry['Falbank']['Settings']['smtppassword'] = $_POST['smtppassword'];
		$usr->registry['Falbank']['Settings']['smtprecipients'] = $_POST['smtprecipients'];
		$usr->registry['Falbank']['Settings']['smtpmyaddress'] = $_POST['smtpmyaddress'];
		$usr->registry['Falbank']['Settings']['companyname'] = $_POST['companyname'];
		$usr->registry['Falbank']['Settings']['smtpfriendlyname'] = $_POST['smtpfriendlyname'];
		$usr->storeRegistry();
	}

	$temp->setText('smtphostname',$usr->registry['Falbank']['Settings']['smtphostname']);
	$temp->setText('smtpusername',$usr->registry['Falbank']['Settings']['smtpusername']);
	$temp->setText('smtppassword',$usr->registry['Falbank']['Settings']['smtppassword']);
	$temp->setText('smtprecipients',$usr->registry['Falbank']['Settings']['smtprecipients']);
	$temp->setText('smtpmyaddress',$usr->registry['Falbank']['Settings']['smtpmyaddress']);
	$temp->setText('companyname',$usr->registry['Falbank']['Settings']['companyname']);
	$temp->setText('smtpfriendlyname',$usr->registry['Falbank']['Settings']['smtpfriendlyname']);
	
	echo($temp->render());
?>
