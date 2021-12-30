<?php
	/**
	 * parts-orders
	 * 
	 * Wykonywarki dla zamówień parts
	 */
	 
	 /**
	  * Usuwa zamówienia na części
	  * @param array $params array(DBCzesciZamawiane)
	  */
	 function parts_order_remove(&$parent, $params)
	 {
	 	list($po) = $params;
	 	$po->__delete();
	 }
	 /**
	  * Dodaje zamówienia na części
	  * @param array $params array(DBZgloszenie, tabela POST)
	  */
	 function parts_order_add(&$parent, $params)
	 {
	 	global $db;
	 	list($cc, $posts) = $params;
	 	$po = new DBCzesciZamawiane($db);
	 	$po->__create($posts['ilosc'],$posts['nrkata'],$posts['nazwa'],$cc->id);
	 }
	  
	EventManager::addHook('parts.order.delete','parts_order_remove','Usuwa zamówienie części');
	EventManager::addHook('parts.order.add','parts_order_add','Wykonuje dodawanie zamówień');
?>
