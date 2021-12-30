<?php
	include_once('includes/bootstrap.php');
	
	if (empty($_GET['id'])) Location('index.php');
	
	if ($_GET['task']=='toWarranty')
	{
		$cc = new DBZgloszenie($db);
		if (!$cc->__load($_GET['id'])) Location('index.php');
		
		$taplr = new TAPLReader('templates/transform_zgloszenie.tpl');
		$temp = $taplr->mkTemplate('index');
		$temp->setText('id',$cc->id);
		$chkmsg = new EventInstance('check.zgloszenie.toWarranty',array($cc));
		if ($chkmsg->wasStopped())
		{	
			Location('index.php');
		} else
		{
			$ei = new EventInstance('zgloszenie.toWarranty',array(&$cc));
		}
	} elseif ($_GET['task']=='ToggleInvoice')
	{
		$cc = new DBZgloszenie($db);
		if (!$cc->__load($_GET['id'])) Location('index.php');
		if ($cc->gwarancyjna == 0) Location('index.php');
		
		$cd = new DBZgloszenieGwarancyjne($db);
		if (!$cd->__load($cc->fk_zgl_gwara)) Location('index.php');


		$taplr = new TAPLReader('templates/transform_invoice.tpl');
		$temp = $taplr->mkTemplate('index');
		$temp->setText('id',$_GET['id']);

		
		$chkmsg = new EventInstance('check.zgloszenie.toggleInvoice',array($cc,$cd));
		if ($chkmsg->wasStopped())
		{
			$temp->setText('error',1);	
		} else
		{
			$ei = new EventInstance('zgloszenie.toggleInvoice',array(&$cc, &$cd));
			$temp->setText('success',1);			
		}
		
	} elseif ($_GET['task']=='ToggleEffect')
	{
		$cc = new DBZgloszenie($db);
		if (!$cc->__load($_GET['id'])) Location('index.php');
		$taplr = new TAPLReader('templates/transform_toggle_effect.tpl');
		$temp = $taplr->mkTemplate('index');
		$temp->setText('id',$cc->id);
		$chkmsg = new EventInstance('check.zgloszenie.toggleEffect',array($cc));
		if ($chkmsg->wasStopped())
		{
			switch ($chkmsg->getErrMsg())
			{
				case 'zgloszenia.toggleEffect.notrepaired':
				$temp->setText('success',0);
				$temp->setText('notrepaired',1);
				break;
			}
			
		} else
		{
			$ei = new EventInstance('zgloszenie.toggleEffect',array(&$cc));
			$cc->__load($cc->id);
			$temp->setText('success',1);
			$temp->setText('zrealizowana',$cc->zrealizowana);
		}
	}
	echo($temp->render());
?>
