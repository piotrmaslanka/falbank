<?php
	include_once('includes/bootstrap.php');
	$taplr = new TAPLReader('templates/uruchomienia.tpl');
	$temp = $taplr->mkTemplate('index');
	
	if ($_GET['mode']=='search')
	{
		$kws = '%'.$_GET['keyword'].'%';
		$res = $db->query('SELECT * FROM Uruchomienia WHERE (nazwa LIKE %s) || (typurzadzenia LIKE %s) || (ulica LIKE %s) || (kodmiejscowosc LIKE %s) ORDER BY id DESC',
			array($kws,$kws,$kws,$kws));
		
	} else
	{
		$res = $db->query('SELECT * FROM Uruchomienia ORDER BY id DESC',array());	
	}
	
	while ($row = $db->toArray($res)) $temp->setBlock('uruchomienia',$row);
	
	
	echo($temp->render());
?>