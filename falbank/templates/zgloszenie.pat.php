<?php

class PazriTG
{
	static function getBox2($warranty, $params)
	{
		if ($warranty==0) return '';
		$spt = '<div id="formbox2">';
		$spt .= '<div class="ifield"><label for="godziny">Godziny (całe)</label><input type="text" id="godziny" name="godziny" value="%godziny%" onchange="resum()"/><br /></div>
		<div class="ifield"><label for="nrproto">Nr protokołu</label><input type="text" id="nrproto" name="nrproto" value="%nrproto%" /><br /></div>
		<div class="ifield"><label for="opis">Opis działań</label><textarea name="opis" id="opis" cols="40" rows="5">%opis%</textarea><br/></div>
		<fieldset><legend>Urządzenie 1</legend>
		<div class="ifield"><label for="u1typ">Typ</label><input type="text" id="u1typ" name="u1typ" value="%u1typ%" /><br /></div>
		<div class="ifield"><label for="u1paliwo">Paliwo</label><input type="text" id="u1paliwo" name="u1paliwo" value="%u1paliwo%" /><br /></div>
		<div class="ifield"><label for="u1nrfabr">Nr fabryczny</label><input type="text" id="u1nrfabr" name="u1nrfabr" value="%u1nrfabr%" /><br /></div>
		<div class="ifield"><label for="u1rokprod">Rok produkcji</label><input type="text" id="u1rokprod" name="u1rokprod" value="%u1rokprod%" /><br /></div>
		</fieldset><fieldset><legend>Urządzenie 2</legend>
		<div class="ifield"><label for="u2typ">Typ</label><input type="text" id="u2typ" name="u2typ" value="%u2typ%" /><br /></div>
		<div class="ifield"><label for="u2nrfabr">Nr fabryczny</label><input type="text" id="u2nrfabr" name="u2nrfabr" value="%u2nrfabr%" /><br /></div>
		<div class="ifield"><label for="u2rokprod">Rok produkcji</label><input type="text" id="u2rokprod" name="u2rokprod" value="%u2rokprod%" /><br /></div>
		</fieldset>
		<div class="ifield"><label for="datauruchom">Data uruch.</label><input type="text" id="datauruchom" name="datauruchom" value="%datauruchom%" /><br /></div>
		<div class="ifield"><label for="ktouruchom">Kto uruchomił</label><input type="text" id="ktouruchom" name="ktouruchom" value="%ktouruchom%" /><br /></div>';
		parSVarRepl($spt, $params);
		return $spt.'</div>';
	}
	/**
	 * Jeśli warranty to zwróci pierwszą skrzynkę z odpowiednim divem
	 */
	static function getBox1($warranty, $params)
	{
		$spt = '<div id="formbox1">'."\n";
		if ($params['added_ok']==1) $spt .= 'Dodano!';
$spt .= '<div class="ifield"><label for="nazwa">Nazwa klienta</label><input type="text" id="nazwa" name="nazwa" value="%nazwa%" /><br /></div>';
		$spt .= '	<div class="ifield"><label for="nrurzadzenia">Nr urządzenia*</label><input type="text" id="nrurzadzenia" name="nrurzadzenia" value="%nrurzadzenia%" /><br /> </div>
	<div class="ifield"><label for="typurzadzenia">Typ urządzenia</label><input type="text" id="typurzadzenia" name="typurzadzenia" value="%typurzadzenia%" /><br /></div> 
	<div class="ifield"><label for="ulica">Ulica</label><input type="text" id="ulica" name="ulica" value="%ulica%" /><br /></div>
	<div class="ifield"><label for="kodmiejscowosc">Kod, miejscowość</label><input type="text" id="kodmiejscowosc" name="kodmiejscowosc" value="%kodmiejscowosc%" /><br /></div>
	<div class="ifield"><label for="telefon">Telefon*</label><input type="text" id="telefon" name="telefon" value="%telefon%" /><br /> </div>
	<div class="ifield"><label for="przyczyna">Przyczyna</label><textarea name="przyczyna" id="przyczyna" cols="40" rows="5">%przyczyna%</textarea><br /></div>
	<div class="ifield"><label for="ktonaprawil">Kto załatwia</label><input type="text" id="ktonaprawil" name="ktonaprawil" value="%ktonaprawil%" /><br /></div> 
	<div class="ifield"><label for="uwagi">Uwagi</label><textarea name="uwagi" id="uwagi" cols="40" rows="5">%uwagi%</textarea><br /></div>';
	
	if ($_GET['id']!='NEW') $spt .= '<div class="ifield"><label for="kiedynaprawione">Kiedy naprawiono</label><input type="text" id="kiedynaprawione" name="kiedynaprawione" value="%kiedynaprawione%" /><br /> </div>';
	
	$spt .= '<div class="ifield"><label for="kiedyzgloszone">Kiedy zgłoszono</label><input type="text" id="kiedyzgloszone" name="kiedyzgloszone" value="%kiedyzgloszone%" /><br /></div> 
	<div class="ifield"><label for="ktoprzyjal">Kto przyjął</label><input type="text" id="ktoprzyjal" name="ktoprzyjal" value="%ktoprzyjal%" /><br /></div>';
	
	if ($_GET['id']=='NEW') $spt .= '<div class="ifield"><label for="poOK">Poinformowano o kosztach</label><input type="checkbox" name="poOK" id="poOK" value="poOK" /></div>';
	
		if ($warranty==1)
		{
			$spt .= '<div class="ifield"><label for="km">Kilometry</label><input type="text" onchange="resum()" id="km" name="km" value="%km%" /><br /></div>';
		}
		parSVarRepl($spt, $params);
		return $spt."\n</div>\n";	
	}
	
	static function getBox3($params)
	{
		$spt .= '<div id="zgloszenie_command">';
		
		if ($params['warranty']=='1') $spt .= 'Kwota: <span id="kasa">0</span><br />';
		
		$spt .= '<div class="zgloszenie_com">
			<a href="delete.php?task=Zgloszenie&amp;id=%id%">Usuń</a>
		</div>';
		$spt .= '<div class="zgloszenie_com"><a href="stdreport.php?id=%id%">Drukuj protokół</a></div>';
		
		if ($params['warranty']=='0') $spt .= '<div class="zgloszenie_com">	
		<a href="transform.php?task=toWarranty&amp;id=%id%">Przekształć w gwarancyjne</a>
	</div>';
	
		if ($params['warranty']=='1') $spt .= '<div class="zgloszenie_com">
			<a href="orderpart.php?id=NEW&amp;zid=%id%">Zamów część</a>
		</div>
		<div class="zgloszenie_com"><a href="addpart.php?zid=%id%">Dodaj część</a></div>';
				
		if ($params['warranty']=='1')
		{
			$spt .= '<div id="partlist">';
			foreach ($params['partlist'] as $part)
			{
				$spt .= '<div class="part">';
				$spt .= "Nazwa: ".Partprocessor::getPartName($part['nrkata'])." <br />";
				$spt .= "NrKat.: ".$part['nrkata']." <br />";
				$spt .= '<a href="delete.php?task=CzesciDodane&amp;zid='.$params['id'].'&amp;id='.$part['id'].'">Odpisz część</a>';
				$spt .= '</div>';	
			}
			$spt .= '</div>';
		}	
		if ($params['zrealizowana']=='1') $spt .= 'Usługa zrealizowana!<br />
		<a href="transform.php?task=ToggleEffect&amp;id=%id%">Ustaw jako niezrealizowaną</a><br/>'; else 
		$spt .= 'Usługa niezrealizowana<br />
		<a href="transform.php?task=ToggleEffect&amp;id=%id%">Ustaw jako zrealizowaną</a><br/>';
		
		if ($params['warranty']=='1')
		{
			if ($params['rozliczono']=='0') $spt .= 'Nie rozliczono';
			else $spt .= 'Rozliczono';
			$spt .= '<br/><a href="transform.php?task=ToggleInvoice&amp;id=%id%">Przełącz</a>';
		}
		
		
		$spt .= '</div>';
		
		parSVarRepl($spt, $params);
		return $spt;
	}
}


$wiadomosc = ' 
  Imię i nazwisko: '.stripslashes($_POST['imienazwisko']).'<br>
  Adres:  '.nl2br(stripslashes($_POST['adres'])).'<br> 
  E-mail: '.stripslashes($_POST['mail']).'<br> 
  Liczba sztuk: '.stripslashes($_POST['ile']).'<br> 
  Wpłata: '.stripslashes($_POST['ile']*45).'zł<br> 
  Numer identyfikacyjny: '.$numer.'<br>
  Dane do zamówienia: i tu sobie coś wpisuję';

function renderindex($params)
{
	foreach($params as $k=>$v)
		$params[$k] = str_replace("%","&#37;",$v);
	$a = file_get_contents('templates/header.tpl');
	$a .= '<title>Zgłoszenie</title>';
	$a .= '<script type="text/javascript" src="webres/sumscript.js"></script>';
	$a .= '<link rel="stylesheet" type="text/css" href="webres/formcss.css" /></head>';
	
	
	if ($params['warranty']=='1') $a .= '<body onload="resum()">'; else $a .= '<body>';
			
			
	$a .= file_get_contents('templates/menu.tpl');
	$b = '<form action="zgloszenie.php?id=%id%" method="post">'; parSVarRepl($b, $params);
	$a .= $b;
	$a .= PazriTG::getBox1($params['warranty'],$params);
	$a .= PazriTG::getBox2($params['warranty'],$params);
	if ($params['action'] != 'add') $a .= PazriTG::getBox3($params);
	$a .= '	<div id="submitpositor"><input type="submit" name="ok" value="ok"/>';
	if ($params['modified']==1) $a .= '<br/>Zmieniono ! C'.$params['seconds'];
	
	if ($params['nie_poinformowano_o_kosztach']==1) $a .= '<p>Nie poinformowano o kosztach!</p>';
	if ($params['niekompletna']==1) $a .= '<p>Dane niekompletne!</p>';	
	
	$a .= '</div></form></body></html>';
	return $a;	
}
?>


