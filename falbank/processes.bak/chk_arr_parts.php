<?php
	/**
	 * Arr-Parts
	 * 
	 * Sprawdzarki dla przychodzących parts
	 */
	 
	 /**
	  * Sprawdza dodawanie części które przyszły
	  * @param array $params array(tablica POST)
	  */	 
	 function chk_arr_parts_add(&$parent, $params)
	 {
	 	global $db;
	 	list($posts) = $params;
	 	$cc = new DBZgloszenie($db);
	 	if (!$cc->__load($posts['fk_nrZam'])) $parent->signalError('arrparts.wrongzamowienie');
	 	if (empty($posts['nrdd'])) $parent->signalError('form.incomplete');
	 	if (empty($posts['data'])) $parent->signalError('form.incomplete');
	 	if (empty($posts['ilosc'])) $parent->signalError('form.incomplete');
	 	if (empty($posts['nrkata'])) $parent->signalError('form.incomplete');
	 	if (empty($posts['nazwa'])) $parent->signalError('form.incomplete');
	 }
	 /**
	  * Sprawdza modyfikację części
	  * @param array $params array(DBCzesciZgloszenia, $_POST)
	  */
	 function chk_arr_parts_modify(&$parent, $params)
	 {
	 	list($pp, $posts) = $params;
	 	global $db;
	 	$cc = new DBZgloszenie($db);
	 	if (!$cc->__load($posts['fk_nrZam'])) $parent->signalError('arrparts.wrongzamowienie');
	 	if (empty($posts['nrdd'])) $parent->signalError('form.incomplete');
	 	if (empty($posts['data'])) $parent->signalError('form.incomplete');
	 	if (empty($posts['ilosc'])) $parent->signalError('form.incomplete');
	 	if (empty($posts['nrkata'])) $parent->signalError('form.incomplete');
	 	if (empty($posts['nazwa'])) $parent->signalError('form.incomplete');
	 }
	 
	 /**
	  * Sprawdza kasowanko części
	  * @param array $params array(DBCzesciZgloszenia)
	  */
	 function chk_arr_parts_del(&$parent, $params)
	 {
	 	
	 }
	 
	 EventManager::addHook('check.parts.arr.add','chk_arr_parts_add','Sprawdza dodanie części które przyszły');
	 EventManager::addHook('check.parts.arr.modify','chk_arr_parts_modify','Sprawdza modyfikację części które przyszły'); 
	 EventManager::addHook('check.parts.arr.del','chk_arr_parts_del','Sprawdza usuwanie części które przyszły');
?>
