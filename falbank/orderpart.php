<?php
	include_once('includes/bootstrap.php');
	
	$taplr = new TAPLReader('templates/orderpart.tpl');
	$temp = $taplr->mkTemplate('index');
	
	if ($_GET['id']=='NEW')		// new order
	{
		if (empty($_GET['zid'])) Location('index.php');
		$cc = new DBZgloszenie($db);
		if (!$cc->__load($_GET['zid'])) Location('index.php');
		if ($cc->gwarancyjna == 0) Location('index.php');
		
		if (isset($_POST['ok']))
		{
			$chkmsg = new EventInstance('check.parts.order.add',array($cc, $_POST));
			if ($chkmsg->wasStopped())
			{
				
			} else
			{
				$ei = new EventInstance('parts.order.add',array(&$cc, $_POST));
				$temp->setText('wasadded',1);
			}
		}	
		
		$temp->setText('action','add');
		$temp->setText('zid',$cc->id);
	}

	$czp = $db->query('SELECT SUM(ilosc), nrkata, nazwa FROM CzesciPrzyjete GROUP BY nrkata');
	
	$tabelka = array();
	
	while ($row = $db->toArray($czp)) $tabelka[$row['nrkata']] = array($row['SUM(ilosc)'], $row['nazwa']);

	$czp = $db->query('SELECT COUNT(id), nrkata FROM CzesciDoProtokolu GROUP BY nrkata');
	
	while ($row = $db->toArray($czp))
	
	{
		$tabelka[$row['nrkata']][0] += -$row['COUNT(id)'];
	}

	foreach ($tabelka as $k=>$v)
	$temp->setBlock('magazyn',array('nazwa'=>$v[1],
									'nrkata'=>$k,
									'ilosc'=>$v[0]));
	
	
	echo($temp->render());
?>
