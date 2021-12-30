<?php
	include_once('includes/bootstrap.php');
		
	if (empty($_GET['id'])) Location('index.php');
	if ($_GET['task']=='Zgloszenie')
	{
		$cc = new DBZgloszenie($db);
		if (!$cc->__load($_GET['id'])) Location('index.php');

		$taplr = new TAPLReader('templates/delete_zgloszenie.tpl');
		$temp = $taplr->mkTemplate('index');
		$temp->setText('id',$_GET['id']);
				
		
		if ($_GET['confirm']=='1')				# potwierdzono kasowanie
		{
			if ($cc->gwarancyjna==1)
			{
				$cd = new DBZgloszenieGwarancyjne($db);
				$cd->__load($cc->fk_zgl_gwara);
			}
		
			$chkmsg = new EventInstance('check.zgloszenie.remove', array($cc, $cd));
			if ($chkmsg->wasStopped())
			{
				
			} else
			{
				$ei = new EventInstance('zgloszenie.remove', array(&$cc, &$cd));
			}
		} else
		{
			$temp->setText('query','1');
		}
	} elseif ($_GET['task']=='CzesciZamowienie')
	{
		if (empty($_GET['zid'])) Location('index.php');
		$taplr = new TAPLReader('templates/delete_parts.tpl');
		$temp = $taplr->mkTemplate('order');
		$po = new DBCzesciZamawiane($db);
		if (!$po->__load($_GET['id'])) Location('index.php');
		$temp->setText('zid',$po->fk_nrZam);
		$chkmsg = new EventInstance('check.parts.order.delete',array($po));
		if ($chkmsg->wasStopped())
		{
			
		} else
		{
			$ei = new EventInstance('parts.order.delete',array(&$po));
			$temp->setText('action','deleted');
		}
	} elseif ($_GET['task']=='Uruchomienie')
	{
		$taplr = new TAPLReader('templates/delete_uruchomienie.tpl');
		$temp = $taplr->mkTemplate('order');
		$uu = new DBUruchomienia($db);
		if (!$uu->__load($_GET['id'])) Location('index.php');
		$chkmsg = new EventInstance('check.uruchomienie.remove',array($uu));
		if ($chkmsg->wasStopped()) Location('index.php');
		$ei = new EventInstance('uruchomienie.remove',array(&$uu));
		$temp->setText('action','deleted');
	} elseif ($_GET['task']=='CzesciDodane')
	{
		$taplr = new TAPLReader('templates/delete_addparts.tpl');
		$temp = $taplr->mkTemplate('order');
		$xx = new DBCzesciDoProtokolu($db);
		if (!$xx->__load($_GET['id'])) Location('index.php');
		$chkmsg = new EventInstance('check.parts.add.del',array($xx));
		if ($chkmsg->wasStopped()) Location('index.php');
		$ei = new EventInstance('parts.add.del',array($xx));
		$temp->setText('action','deleted');
		$temp->setText('zid',$_GET['zid']);
	}
	
	echo($temp->render());
?>
