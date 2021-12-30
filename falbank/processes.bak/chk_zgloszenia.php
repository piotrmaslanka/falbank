<?php
	/**
	 * chk_zgloszenia
	 * 
	 * Sprawdzarki dla zgłoszeń
	 */
	 
	/**
	 * Sprawdzarka dodawnia zgłoszeń
	 * @param array $params array(tablica POST)
	 */
	function chk_zgloszenia_add(&$parent, $params)
	{
		list($posts) = $params;
		if (empty($posts['nrurzadzenia'])) $parent->signalError('form.incomplete');
		if (empty($posts['ktoprzyjal'])) $parent->signalError('form.incomplete');
		if (empty($posts['telefon'])) $parent->signalError('form.incomplete');
		if ($posts['poOK'] != 'poOK') $parent->signalError('zgladd.poinformujokosztach');
	}	 
	
	/**
	 * Sprawdzarka modyfikacji zgłoszeń
	 * @param array $param array(id, tablica POST, gwarancyjna)
	 */
	function chk_zgloszenia_modify(&$parent, $params)
	{
		list($id, $posts, $gwarancyjna) = $params;
		if (empty($posts['nrurzadzenia'])) $parent->signalError('form.incomplete');	
		if (empty($posts['ktoprzyjal'])) $parent->signalError('form.incomplete');
		if (empty($posts['telefon'])) $parent->signalError('form.incomplete');		
	}
	
	/**
	 * Sprawdzarka usuwania zgłoszeń
	 * @param array $param array(DBZgloszenie, DBZgloszenieGwarancyjne)
	 */
	function chk_zgloszenia_remove(&$parent, $params)
	{
		list($cc, $cd) = $params;
	}
	
	/**
	 * Sprawdzarka przełączenia realizacji
	 * @param array $param array (DBZgloszenie)
	 */
	function chk_zgloszenia_toggleEffect(&$parent, $params)
	{
		list($cc) = $params;
		if ($cc->zrealizowana == 0)
		{
			if (!$cc->ktonaprawil) $parent->signalError('zgloszenia.toggleEffect.notrepaired');
			if (!$cc->kiedynaprawione) $parent->signalError('zgloszenia.toggleEffect.notrepaired');
		}
	}
	
	/**
	 * Sprawdzarka przełączenia faktury
	 * @param array $param array (DBZgloszenie, DBZgloszenieGwarancyjne)
	 */
	function chk_zgloszenia_toggleInvoice(&$parent, $params)
	{
		list($cc, $cd) = $params;		
	}
	
	EventManager::addHook('check.zgloszenie.toggleInvoice','chk_zgloszenia_toggleInvoice','Sprawdza przełączanie rozliczenia');
	EventManager::addHook('check.zgloszenie.add','chk_zgloszenia_add','Sprawdza poprawość dodawanego zgłoszenia');
	EventManager::addHook('check.zgloszenie.modify','chk_zgloszenia_modify','Sprawdza poprawność modyfikacji zgłoszenia');
	EventManager::addHook('check.zgloszenie.remove','chk_zgloszenia_remove','Sprawdza poprawność usunięcia zgłoszenia');
	EventManager::addHook('check.zgloszenie.toggleEffect','chk_zgloszenia_toggleEffect','Sprawdza przełączanie realizacji');
?>
