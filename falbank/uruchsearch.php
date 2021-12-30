<?php
	include_once('includes/bootstrap.php');
	$taplr = new TAPLReader('templates/uruchomienie.tpl');
	$temp = $taplr->mkTemplate('search');
	echo($temp->render());
?>