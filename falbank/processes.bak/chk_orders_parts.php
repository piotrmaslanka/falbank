<?php
	/**
	 * Parts-orders
	 * 
	 * Sprawdzarki dla zamówień parts
	 */
	 
	 /**
	  * Sprawdza dodawanie zamówień części
	  * @param array $params array(DBZgloszenie, tabela POST)
	  */
	 function chk_parts_order_add(&$parent, $params)
	 {
	 	list($cc, $posts) = $params;	
	 	
	 	if (empty($posts['nrkata'])) $parent->signalError('form.incomplete');	
	 	if (empty($posts['nazwa'])) $parent->signalError('form.incomplete');	
	 	if (empty($posts['ilosc'])) $parent->signalError('form.incomplete');	
	 }
	 /**
	  * Sprawdza poprawność usunięcia części 
	  * @param array $params array(DBCzesciZamawiane)
	  */
	 function chk_parts_order_remove(&$parent, $params)
	 {
	 	list($po) = $params;
	 }
	 
	 EventManager::addHook('check.parts.order.delete','chk_parts_order_remove','Sprawdza usuwanie zamówień części');
	 EventManager::addHook('check.parts.order.add','chk_parts_order_add','Sprawdza dodawanie zamówień');
?>
