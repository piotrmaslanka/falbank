<?php
	date_default_timezone_set('Europe/Warsaw');
	include_once('includes/bootstrap.php');
	$taplr = new TAPLReader('templates/index.tpl');
	$temp = $taplr->mkTemplate('index');
	echo($temp->render());
?>
