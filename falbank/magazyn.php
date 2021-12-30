<?php
	include_once('includes/bootstrap.php');
	
	$taplr = new TAPLReader('templates/magazyn.tpl');
	$temp = $taplr->mkTemplate('index');
	
	$czp = $db->query('SELECT SUM(ilosc), nrkata, nazwa FROM CzesciPrzyjete GROUP BY nrkata');
	
	$tabelka = array();
	
	while ($row = $db->toArray($czp)) $tabelka[$row['nrkata']] = array($row['SUM(ilosc)'], $row['nazwa']);

	$czp = $db->query('SELECT COUNT(id), nrkata FROM CzesciDoProtokolu GROUP BY nrkata');
	
	while ($row = $db->toArray($czp))
	
	{
		$tabelka[$row['nrkata']][0] += -$row['COUNT(id)'];
	}

	foreach ($tabelka as $k=>$v)
	$temp->setBlock('magitem',array('nazwa'=>$v[1],
									'nrkata'=>$k,
									'ilosc'=>$v[0]));
	
	echo($temp->render());
?>
