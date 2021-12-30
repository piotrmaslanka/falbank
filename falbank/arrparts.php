<?php
	include_once('includes/bootstrap.php');
	$taplr = new TAPLReader('templates/arrparts.tpl');
	$temp = $taplr->mkTemplate('index');
	
	$res = $db->query("SELECT * FROM CzesciPrzyjete ORDER BY id DESC",array());
	
	while ($row = $db->toArray($res))
		$temp->setBlock('arrparts',$row);
	
	
	echo($temp->render());
?>
