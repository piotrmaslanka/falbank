<?php
	include_once('includes/bootstrap.php');
	
	$paplr = new PHPAPLReader('templates/zgloszenie.pat.php');
	$temp = $paplr->mkTemplate('index');
	
	if ($_GET['id']=='NEW')					// dodawanie
	{
		if (isset($_POST['ok']))
		{
			$chkmsg = new EventInstance('check.zgloszenie.add',array($_POST));
			if ($chkmsg->wasStopped())
			{
				if ($chkmsg->getErrMsg() == 'zgladd.poinformujokosztach') $temp->setText('nie_poinformowano_o_kosztach',1);
				if ($chkmsg->getErrMsg() == 'form.incomplete') $temp->setText('niekompletna',1); 
				$temp->setText('error','incomplete');				
			} else
			{
				$ei = new EventInstance('zgloszenie.add',array($_POST));
				$temp->setText('added_ok',1);
			}
		} else
		{
			$temp->setText('kiedyzgloszone',date($conf->config['Defaults']['TimeFormat']));
		}
		
		$temp->setText('action','add');
		$temp->setText('id','NEW');

		$temp->setText('nazwa',$_POST['nazwa']);
		$temp->setText('nrurzadzenia',$_POST['nrurzadzenia']);
		$temp->setText('typurzadzenia',$_POST['typurzadzenia']);
		$temp->setText('ulica',$_POST['ulica']);
		$temp->setText('kodmiejscowosc',$_POST['kodmiejscowosc']);
		$temp->setText('telefon',$_POST['telefon']);
		$temp->setText('przyczyna',$_POST['przyczyna']);
		$temp->setText('ktonaprawil',$_POST['ktonaprawil']);
		$temp->setText('uwagi',$_POST['uwagi']);
		$temp->setText('kiedynaprawione',$_POST['kiedynaprawione']);
		$temp->setText('ktoprzyjal',$_POST['ktoprzyjal']);
		
	} else										// modyfikacja
	{
		$cc = new DBZgloszenie($db);
		if (!$cc->__load($_GET['id'])) Location('index.php');
		if ($cc->gwarancyjna==1) 
		{
			$cd = new DBZgloszenieGwarancyjne($db);
			$cd->__load($cc->fk_zgl_gwara);
			$temp->setText('warranty',1);
		}
		$temp->setText('zrealizowana',$cc->zrealizowana);
		
		if (isset($_POST['ok']))			// zatwierdzamy sopmoda
		{
			$chkmsg = new EventInstance('check.zgloszenie.modify',array($cc->id, $_POST, ($cc->gwarancyjna==1)));
			if ($chkmsg->wasStopped())
			{
				$temp->setText('error','incomplete');
			} else
			{
				$ei = new EventInstance('zgloszenie.modify', array($_POST, &$cc, &$cd, ($cc->gwarancyjna==1)));
							}
			$temp->setText('modified',1);
		}

		$cc->__load($cc->id);
		if ($cc->gwarancyjna==1) $cd->__load($cd->id);

		
		$temp->setText('id',$cc->id);
		$temp->setText('nrurzadzenia',$cc->nrurzadzenia);
		$temp->setText('typurzadzenia',$cc->typurzadzenia);
		$temp->setText('ulica',$cc->ulica);
		$temp->setText('kodmiejscowosc',$cc->kodmiejscowosc);
		$temp->setText('telefon',$cc->telefon);
		$temp->setText('przyczyna',$cc->przyczyna);
		$temp->setText('ktonaprawil',$cc->ktonaprawil);
		$temp->setText('uwagi',$cc->uwagi);									
		$temp->setText('kiedynaprawione', ($cc->kiedynaprawione==false)
										? '' 
										: date($conf->config['Defaults']['TimeFormat'], $cc->kiedynaprawione));
		$temp->setText('kiedyzgloszone',date($conf->config['Defaults']['TimeFormat'],$cc->kiedyzgloszone));
		$temp->setText('ktoprzyjal',$cc->ktoprzyjal);
		$temp->setText('nazwa',$cc->nazwa);
		
		if ($cc->gwarancyjna==1)
		{
			$temp->setText('km',$cd->km);
			$temp->setText('godziny',$cd->godziny);
			$temp->setText('nrproto', $cd->nrproto);
			$temp->setText('opis',$cd->opis);
			$temp->setText('u1typ',$cd->u1typ);
			$temp->setText('u1paliwo',$cd->u1paliwo);
			$temp->setText('u1nrfabr',$cd->u1nrfabr);
			$temp->setText('u1rokprod',$cd->u1rokprod);
			$temp->setText('u2typ',$cd->u2typ);
			$temp->setText('u2nrfabr',$cd->u2nrfabr);
			$temp->setText('u2rokprod',$cd->u2rokprod);
			$temp->setText('datauruchom',($cd->datauruchom==false)
										? '' 
										: date($conf->config['Defaults']['TimeFormat'], $cd->datauruchom));
			$temp->setText('ktouruchom',$cd->ktouruchom);
			$temp->setText('zamkniete',$cd->zamkniete);
			$temp->setText('rozliczono',$cd->rozliczono);
			
			$res = $db->query('SELECT * FROM CzesciDoProtokolu WHERE fk_nrZam=%s',array($cc->id));
			
			while ($row = $db->toArray($res))
				$temp->setBlock('partlist',$row);
				
		} else
		{
			$temp->setText('warranty',0);
		}
	}
	$temp->setText('seconds',date('s'));
	echo($temp->render());
?>
