<?php

	define('FPDF_FONTPATH','libs/html2fpdf/font/');
	require_once('libs/html2fpdf/html2fpdf.php'); 	
	/**
	 * Generuje plik zamówienia
	 * @param bool $workcopy determinuje czy jest to kopia robocza dla firmy czy wersja wysyłkowa
	 * @param int $zid ID zgłoszenia
	 * @param DBZgloszenie $cc zgloszenie
	 * @param DBZgloszenieGwarancyjne $cp zgloszenie gwarancyjne
	 */
	function generateOrder($workcopy, $cc, $cd)
	{
		global $db,$usr;
		$taplr = new TAPLReader('generators/order_parts/resources/order_template.tpl');
		$temp = $taplr->mkTemplate('order');
		
		$temp->setText('meta_workcopy',($workcopy ? 1 : 0));
		
		
		$temp->setText('companyname',$usr->registry['Falbank']['Settings']['companyname']);
		
		$temp->setText('nazwa',$cc->nazwa);
	
		$temp->setText('typurzadzenia',$cc->typurzadzenia);
		$temp->setText('nrurzadzenia',$cc->nrurzadzenia);
		$temp->setText('id',$cc->id);
		$temp->setText('data',(	!$cd->datauruchom ? 'WPISZ DATĘ URUCHOMIENIA' :
			date('Y-m-d',$cd->datauruchom)));
		$temp->setText('ulica',$cc->ulica);
		$temp->setText('kodmiejscowosc',$cc->kodmiejscowosc);
		$temp->setText('telefon',$cc->telefon);
		$temp->setText('przyczyna',$cc->przyczyna);
		$temp->setText('uwagi',$cc->uwagi);
		$temp->setText('ktoprzyjal',filter_crew($cc->ktoprzyjal));
		$temp->setText('datawyslania',date('Y-m-d'));
		
		$res = $db->query('SELECT * FROM CzesciZamawiane WHERE fk_nrZam=%s',array($cc->id));
		while ($row = $db->toArray($res)) $temp->setBlock('parts',$row);

		$html = $temp->render();		

		$html = iconv('UTF-8','ISO-8859-2',$html);			
					
		$nname = "temp/".rand(1,1000000).".pdf";

		$dompdf = new HTML2FPDF();
		$dompdf->AddPage();
		$dompdf->WriteHTML($html);
		$dompdf->Output($nname);

		return $nname;
	}
?>
