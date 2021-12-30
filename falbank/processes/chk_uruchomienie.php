<?php

	function chk_uruchomienie_add(&$parent, $params)
	{
		list($posts) = $params;
		if (!strtotime($posts['datauruch'])) $parent->signalError('form.incomplete');
	}
	
	/**
	 * @param array $params array(DBUruchomienie, lista POST)
	 */
	function chk_uruchomienie_modify(&$parent, $params)
	{
		
	}

	/**
	 * @param array $params array(DBUruchomienie)
	 */	
	function chk_uruchomienie_delete(&$parent, $params)
	{
		
	}
	
	EventManager::addHook('check.uruchomienie.add','chk_uruchomienie_add','Sprawdza dodawanie uruchomień');
	EventManager::addHook('check.uruchomienie.modify','chk_uruchomienie_modify','Sprawdza modyfikację uruchomień');
	EventManager::addHook('check.uruchomienie.remove','chk_uruchomienie_delete','Sprawdza usuwanie uruchomień');

?>