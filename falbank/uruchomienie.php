<?php
	include_once('includes/bootstrap.php');
	$taplr = new TAPLReader('templates/uruchomienie.tpl');
	$temp = $taplr->mkTemplate('index');
	
	if (empty($_GET['id'])) Location('index.php');
	
	if ($_GET['id']=='NEW')
	{
		if ($_POST['ok']=='ok')
		{
			$chkmsg = new EventInstance('check.uruchomienie.add',array($_POST));
			if ($chkmsg->wasStopped())
			{
				$temp->setText('niekompletna',1);
			} else
			{
				$chkmsg = new EventInstance('uruchomienie.add',array($_POST));
				$temp->setText('dodano',1);
			}
		} else
		{
			$temp->setText('ulica',$_POST['ulica']);
			$temp->setText('typurzadzenia',$_POST['typurzadzenia']);
			$temp->setText('kodmiejscowosc',$_POST['kodmiejscowosc']);
			$temp->setText('nazwa',$_POST['nazwa']);
			$temp->setText('datauruch',$_POST['datauruch']);
			$temp->setText('dataostr',$_POST['dataostr']);
			$temp->setText('ktouruch',$_POST['ktouruch']);
			$temp->setText('uwagi',$_POST['uwagi']);
		}
	} else
	{
		$uu = new DBUruchomienia($db);
		if (!$uu->__load($_GET['id'])) Location('index.php');
		
		if ($_POST['ok']=='ok')
		{
			$chkmsg = new EventInstance('check.uruchomienie.modify',array($uu, $_POST));
			if ($chkmsg->wasStopped())
			{
				$temp->setText('niekompletna',1);	
			} else
			{
				$ei = new EventInstance('uruchomienie.modify',array(&$uu, $_POST));
				$temp->setText('modified',1);
			}
		}

		$uu->__load($uu->id);
		
		$temp->setText('ulica',$uu->ulica);
		$temp->setText('typurzadzenia',$uu->typurzadzenia);
		$temp->setText('kodmiejscowosc',$uu->kodmiejscowosc);
		$temp->setText('nazwa',$uu->nazwa);
		$temp->setText('uwagi',$uu->uwagi);
		$temp->setText('ktouruch',$uu->ktouruch);
		$temp->setText('datauruch',($uu->datauruch==false)
										? '' 
										: date($conf->config['Defaults']['TimeFormat'], $uu->datauruch));
		$temp->setText('dataostr',($uu->dataostr==false)
										? '' 
										: date($conf->config['Defaults']['TimeFormat'], $uu->dataostr));
	}
	$temp->setText('id',$_GET['id']);
	echo($temp->render());
?>
