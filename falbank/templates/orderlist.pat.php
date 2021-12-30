<?php
function renderindex($params)
{
	global $db,$conf;
	$a = file_get_contents('templates/header.tpl');
	$a .= '<title>Lista zamówień części</title>';
	$a .= '<link rel="stylesheet" type="text/css" href="webres/orderlist.css" /></head><body>';
	$a .= file_get_contents('templates/menu.tpl');
	
	$cc = new DBZgloszenie($db);
	$cp = new DBZgloszenieGwarancyjne($db);
	
	$currentzgloszenie = -1;
	foreach ($params['orders'] as $order)
	{
		if ($currentzgloszenie != $order['fk_nrZam'])
		{
			if ($currentzgloszenie != -1) $a .= '</div></div>';
			$currentzgloszenie = $order['fk_nrZam'];
			$a .= '<div class="zamowienie"><div class="zam_header"><a href="zgloszenie.php?id='.$order['fk_nrZam'].'">
					Zamówienie do zgłoszenia nr '.$order['fk_nrZam'].'</a></div><div class="zam_header_mini">';
				
				$cc->__load($order['fk_nrZam']);
				$cp->__load($cc->fk_zgl_gwara);
				
				list($lista_czesci, $cos_nie_doszlo) = Partprocessor::getPartsProfile($cc->id);
				if ($cos_nie_doszlo == 1) $a .= '<span style="color: #800080;">Niektóre części nie doszły</span>';
				if ($cos_nie_doszlo == 0) $a .= 'Wszystko doszło!';
				
				
				$a .= '</div><div class="zam_header_additional">';
					if ($cp->wyslano_liste_czesci == 0) $a .= 'Nie wysłano!';
					else $a .= 'Wysłano '.date($conf->config['Defaults']['TimeFormat'],$cp->wyslano_liste_czesci);
				
				$a .= '<br/><a href="send_order_list.php?id='.$order['fk_nrZam'].'">Wyślij</a><br/>
							<a href="send_order_list.php?id='.$order['fk_nrZam'].'&amp;printonly=1">Tylko drukuj</a>';
					
			$a .= '</div><div class="zam_content">';		
		}
		$a .= '<div class="zam_item">';
		$a .= '<strong>Nr katalogowy:</strong> '.$order['nrkata'].'<br/>';
		$a .= '<strong>Ilość:</strong> '.$order['ilosc'].'<br/>';
		$a .= '<strong>Nazwa:</strong> '.$order['nazwa'].'<br/>';
		$a .= '<a href="delete.php?task=CzesciZamowienie&zid='.$order['fk_nrZam'].'&id='.$order['id'].'">Usuń</a></div>';
	}
	
	return $a.'</div></div></body></html>';			
}
?>
