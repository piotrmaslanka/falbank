<?php
	
	function generateReport($cc)
	{
		global $conf;
		$tplr = new TAPLReader('generators/standard_report/resources/dokument.tpl');
		$temp = $tplr->mkTemplate('index');
		$temp->setText('nazwa',$cc->nazwa);
		$temp->setText('nrproto',$cc->id);
		$temp->setText('ulica', $cc->ulica);
		$temp->setText('telefon',$cc->telefon);
		$temp->setText('datazgloszenia',date($conf->config['Defaults']['TimeFormat'], $cc->kiedyzgloszone));
		$temp->setText('datazalatwienia',date($conf->config['Defaults']['TimeFormat'], $cc->kiedynaprawione));
		$temp->setText('przyczyna',$cc->przyczyna);
		$temp->setText('ktonaprawil',filter_crew($cc->ktonaprawil));
		
		$kod = apreg_match('/[0-9]{2}-[0-9]{3}/',$cc->kodmiejscowosc);
		$temp->setText('kod',$kod[0][0]);
		
		return $temp->render();
	}
?>