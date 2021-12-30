<?php
	include_once('includes/bootstrap.php');
	
	$taplr = new TAPLReader('templates/arrpart.tpl');
	$temp = $taplr->mkTemplate('index');
	
	if (empty($_GET['id'])) Location('index.php');
	
	$temp->setText('id',$_GET['id']);	
	
	if ($_GET['id']=='NEW')
	{
		if ($_POST['ok']=='ok')
		{
			$chkmsg = new EventInstance('check.parts.arr.add',array($_POST));
			if ($chkmsg->wasStopped())
			{
				switch ($chkmsg->getErrMsg())
				{
					case 'arrparts.wrongzamowienie':
						$temp->setText('error','wrongzamowienie');
						break;
					case 'form.incomplete':
						$temp->setText('error','formincomplete');
						break;
				}
			} else
			{
				$ei = new EventInstance('parts.arr.add',array($_POST));
				$temp->setText('action','added');
			}
		}
		
		
		$temp->setText('nrdd',$_POST['nrdd']);
		$temp->setText('data',$_POST['data']);
		$temp->setText('nrkata',$_POST['nrkata']);
		$temp->setText('nazwa',$_POST['nazwa']);
		$temp->setText('ilosc',$_POST['ilosc']);
		$temp->setText('fk_nrZam',$_POST['fk_nrZam']);
		
	} else
	{
		$pp = new DBCzesciPrzyjete($db);
		if (!$pp->__load($_GET['id'])) Location('index.php'); 
		
		if ($_POST['ok']=='ok')
		{
			$chkmsg = new EventInstance('check.parts.arr.modify',array($pp,$_POST));
			if ($chkmsg->wasStopped())
			{
				switch ($chkmsg->getErrMsg())
				{
					case 'arrparts.wrongzamowienie':
						$temp->setText('error','wrongzamowienie');
						break;
					case 'form.incomplete':
						$temp->setText('error','formincomplete');
						break;
				}				
			} else	
			{
				$ei = new EventInstance('parts.arr.modify',array(&$pp, $_POST));
				$temp->setText('action','modifiedok');
			}
		}
		
		$temp->setText('nrdd',$pp->nrdd);
		$temp->setText('data',($pp->data == false ? '' : date($conf->config['Defaults']['TimeFormat'], $pp->data)));
		$temp->setText('nrkata',$pp->nrkata);
		$temp->setText('nazwa',$pp->nazwa);
		$temp->setText('ilosc',$pp->ilosc);
		$temp->setText('fk_nrZam',$pp->fk_nrZam);
	}


	$temp->setText('seconds',date('s'));
	echo($temp->render());
?>
