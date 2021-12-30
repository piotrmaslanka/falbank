<?php
	include_once('includes/bootstrap.php');
	$taplr = new PHPAPLReader('templates/orderlist.pat.php');
	$temp = $taplr->mkTemplate('index');
		
	$res = $db->query('SELECT * FROM CzesciZamawiane ORDER BY fk_nrZam DESC, id');
	
	while ($row = $db->toArray($res))
	{
		$temp->setBlock('orders',$row);
	}
	
	echo($temp->render());
?>
