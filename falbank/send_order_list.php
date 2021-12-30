<?php
	include_once('includes/bootstrap.php');
	include_once('generators/order_parts/generator.php');
	
	if (empty($_GET['id'])) Location('index.php');	
	
	$cc = new DBZgloszenie($db);
	if (!$cc->__load($_GET['id'])) Location('index.php');
	$cp = new DBZgloszenieGwarancyjne($db);
	$cp->__load($cc->fk_zgl_gwara);
	
	$chkmsg = new EventInstance('check.order_list.send',array(&$cc,&$cp));
	if ($chkmsg->wasStopped())
	{
		$taplr = new TAPLReader('templates/send_order_list.tpl');
		$temp = $taplr->mkTemplate('index');
		$temp->setText('error',1);
		$temp->setText('id',$cc->id);	
		$temp->setText('formincomplete',1);
		echo($temp->render());
	} else
	{
		if ($_GET['printonly'] != 1) 
		{
			$ei = new EventInstance('order_list.send',array(&$cc, &$cp));	
			if ($ei->wasStopped())
			{
				$taplr = new TAPLReader('templates/send_order_list.tpl');
				$temp = $taplr->mkTemplate('index');
				$temp->setText('error',1);
				$temp->setText('id',$cc->id);	
				$temp->setText('mailfailed',1);
				echo('<a href="'.$temp->render().'">Dokument</a>');
				$content_already = 1;
			}
		}
		if ($content_already != 1) echo('<a href="'.generateOrder(true, $cc, $cp).'">Dokument</a>');
	}
?>
