<?php
	/**
	 * zgloszenia
	 * 
	 * Wykonywarki dla zgłoszeń
	 */
	 
	 /** 
	  * Dodawanie zgłoszeń
	  * @param array $params array(tabela POST)
	  */
	 function zgloszenia_add(&$parent, $params)
	 {
	 	global $db;
	 	list($posts) = $params;
	 	$cc = new DBZgloszenie($db);
	 	
	 	$cc->__create(trim($posts['nrurzadzenia']),
	 				  trim($posts['typurzadzenia']),
	 				  $posts['ulica'],
	 				  $posts['kodmiejscowosc'],
	 				  $posts['telefon'],
	 				  $posts['przyczyna'],
	 				  $posts['ktonaprawil'],
	 				  $posts['uwagi'],
	 				  APIDatabase::svNull(),
	 				  strtotime($posts['kiedyzgloszone']),
	 				  $posts['ktoprzyjal'],
	 				  0,
	 				  0,
	 				  0,
	 				  $posts['nazwa']);
	 }
	 
	 /**
	  * Modyfikacja zgłoszeń
	  * @param array $params array(posty, &$cc, &$cd, bool:czy_gwarancyjna)
	  */
	 function zgloszenia_modify(&$parent, $params)
	 {
	 	list($posts, $cc, $cd, $gwarancyjna) = $params;
	 	$cc->nrurzadzenia = trim($posts['nrurzadzenia']);
	 	$cc->typurzadzenia = trim($posts['typurzadzenia']);
	 	$cc->ulica = $posts['ulica'];
	 	$cc->kodmiejscowosc = $posts['kodmiejscowosc'];
	 	$cc->telefon = $posts['telefon'];
	 	$cc->przyczyna = $posts['przyczyna'];
	 	$cc->nazwa = $posts['nazwa'];
	 	$cc->ktonaprawil = $posts['ktonaprawil'];
	 	$cc->uwagi = $posts['uwagi'];
	 	$cc->kiedynaprawione = (empty($posts['kiedynaprawione']) 
	 							? APIDatabase::svNull()
	 							: strtotime($posts['kiedynaprawione']));
	 	$cc->kiedyzgloszone = strtotime($posts['kiedyzgloszone']);
	 	$cc->ktoprzyjal = $posts['ktoprzyjal'];
		$cc->__store();
	 	if ($cc->gwarancyjna == 1)
	 	{
	 		$cd->km = $posts['km'];
	 		$cd->godziny = $posts['godziny'];
	 		$cd->nrproto = $posts['nrproto'];
	 		$cd->opis = $posts['opis'];
	 		$cd->u1typ = $posts['u1typ'];
	 		$cd->u1paliwo = $posts['u1paliwo'];
	 		$cd->u1rokprod = $posts['u1rokprod'];
	 		$cd->u1nrfabr = $posts['u1nrfabr'];
	 		$cd->u2typ = $posts['u2typ'];
	 		$cd->u2rokprod = $posts['u2rokprod'];
	 		$cd->u2nrfabr = $posts['u2nrfabr'];
	 		$cd->datauruchom = empty($posts['datauruchom']) 
	 							? APIDatabase::svNull()
	 							: strtotime($posts['datauruchom']);
	 		$cd->ktouruchom = $posts['ktouruchom'];
			$cd->__store();
	 	}
		
	 }
	 
	 /**
	  * Usuwarka zgłoszeń
	  * @param array $params array(&DBZgloszenie, &DBZgloszenieGwarancyjne)
	  */
	  function zgloszenia_remove(&$parent, $params)
	  {
	  	list($cc, $cd) = $params;
	  	if ($cc->gwarancyjna == 1) $cd->__delete();
	  	$cc->__delete();
	  }
	  /**
	   * Przełączarka zamknięcia zgłoszeń
	   */
	  function zgloszenia_toggleEffect(&$parent, $params)
	  {
	  	list($cc) = $params;
	  	$cc->zrealizowana = ($cc->zrealizowana == 0 ? 1 : 0);
		$cc->__store();
	  }
	  /**
	   * Przełączarka faktury
	   */
	  function zgloszenia_toggleInvoice(&$parent, $params)
	  {
	  	list($cc, $cd) = $params;
	  	$cd->rozliczono = ($cd->rozliczono == 0 ? 1 : 0);
		$cd->__store();
	  }
	 
	 EventManager::addHook('zgloszenie.toggleInvoice','zgloszenia_toggleInvoice','Przełącza fakturę');
	 EventManager::addHook('zgloszenie.add','zgloszenia_add','Dodaje zgłoszenie');
	 EventManager::addHook('zgloszenie.modify','zgloszenia_modify','Modyfikuje zgłoszenie');
	 EventManager::addHook('zgloszenie.remove','zgloszenia_remove','Usuwa zgłoszenie');
	 EventManager::addHook('zgloszenie.toggleEffect','zgloszenia_toggleEffect','Przełącza realizację zgłoszenia');
?>
