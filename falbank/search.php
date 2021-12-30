<?php
	include_once('includes/bootstrap.php');
	$taplr = new TAPLReader('templates/search.tpl');
	$temp = $taplr->mkTemplate('index');
	echo($temp->render());
?>