<?php
	include_once('filters/filter_crew.php');
	
	function generateWarrantyReport($cc, $cd)
	{
		global $db;
		$taplr = new TAPLReader('generators/service_report/resources/raport.tpl');
		$temp = $taplr->mkTemplate('index');
		
		$temp->setText('nr',$cd->nrproto);
		$temp->setText('nazwa',$cc->nazwa);
		$temp->setText('adrestelefon',$cc->ulica.' tel. '.$cc->telefon);
		$temp->setText('telefon','tel. do klienta '.$cc->telefon);
		
		$kod = apreg_match('/[0-9]{2}-[0-9]{3}/',$cc->kodmiejscowosc);
		$kod = $kod[0][0];
		$miejscowosc = str_replace($kod, '', $cc->kodmiejscowosc);
		
		$temp->setText('godzin',$cd->godziny);
		$temp->setText('km',$cd->km);
		
		$temp->setText('korobocizna',$cd->godziny*93);
		$temp->setText('kodojazd',$cd->km*1.2);
		$temp->setText('koczesci',0);		
		$temp->setText('razemnetto',$cd->godziny*93 + $cd->km*1.2);
		
		$temp->setText('datauruchom',(!$cd->datauruchom ? '' : date('Y-m-d',$cd->datauruchom)));
		$temp->setText('ktouruchamial',filter_crew($cd->ktouruchom));
		
		$temp->setText('kodpocztowy',$kod);
		$temp->setText('miejscowosc',$miejscowosc);
		
		$temp->setText('czynnosci',$cd->opis);
		
		$temp->setText('u1paliwo',$cd->u1paliwo);
		$temp->setText('u1typ',$cd->u1typ);
		$temp->setText('u1nrfabr',$cd->u1nrfabr);
		$temp->setText('u1rokprod',$cd->u1rokprod);
		
		$temp->setText('nazwiskoserwisanta',filter_crew($cc->ktonaprawil));
		
		$temp->setText('data',date('Y-m-d',$cc->kiedynaprawione));
				
				
				
		$temp->setText('u2typ',$cd->u2typ);
		$temp->setText('u2nrfabr',$cd->u2nrfabr);
		$temp->setText('u2rokprod',$cd->u2rokprod);
		
		$res = $db->query("SELECT * FROM CzesciDoProtokolu WHERE fk_nrZam=%s",array($cc->id));
		if ($row = $db->toArray($res))
		{
			$temp->setText('cz1nazwa',Partprocessor::getPartName($row['nrkata']));
			$temp->setText('cz1nr',$row['nrkata']);
			if ($row = $db->toArray($res))
			{
				$temp->setText('cz2nazwa',Partprocessor::getPartName($row['nrkata']));
				$temp->setText('cz2nr',$row['nrkata']);
				if ($row = $db->toArray($res))
				{
					$temp->setText('cz3nazwa',Partprocessor::getPartName($row['nrkata']));
					$temp->setText('cz3nr',$row['nrkata']);
				}
			}
		}
		
		/*$temp->setText('',);
		
		$temp->setText('',);
		$temp->setText('',);
		$temp->setText('',);
		$temp->setText('',);
		$temp->setText('',);
		$temp->setText('',);
		$temp->setText('',);
		$temp->setText('',);*/
		
		
		return $temp->render();
	}
?>
