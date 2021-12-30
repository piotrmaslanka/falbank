<?php
	/**
	 * Arr-Parts
	 * 
	 * Wykonywarki dla przychodzących parts
	 */
	 
	 /**
	  * Dodaje części które przyszły
	  * @param array $params array(tablica POST)
	  */
	 function arr_parts_add(&$parent, $params)
	 {
	 	global $db;
	 	list($posts) = $params;
	 	$pp = new DBCzesciPrzyjete($db);
	 	$pp->__create(strtotime($posts['data']),
	 				 trim($posts['nrdd']),
	 				 trim($posts['fk_nrZam']),
	 				 $posts['ilosc'],
	 				 trim($posts['nrkata']),
	 				 $posts['nazwa']);
	 }
	 
	 /**
	  * Edytuje części które przyszły
	  * @param array $params array(DBCzesciPrzyjete, $_POST)
	  */
	 function arr_parts_edit(&$parent, $params)
	 {
	 	list($pp, $posts) = $params;
	 	$pp->nrdd = trim($posts['nrdd']);
	 	$pp->data = strtotime($posts['data']);
	 	$pp->ilosc = $posts['ilosc'];
	 	$pp->nrkata = trim($posts['nrkata']);
	 	$pp->nazwa = $posts['nazwa'];
	 	$pp->fk_nrZam = trim($posts['fk_nrZam']);
		$pp->__store();
	 }
	 
	 /**
	  * Kasuje części które przyszły
	  * @param array $params array(DBCzesciPrzyjete)
	  */
	 function arr_parts_del(&$parent, $params)
	 {
	 	list($pp) = $params;
	 	$pp->__delete();
	 }
	 
	 EventManager::addHook('parts.arr.add','arr_parts_add','Dodaje części które przyszły');
	 EventManager::addHook('parts.arr.modify','arr_parts_edit','Modyfikuje części które przyszły');
	 EventManager::addHook('parts.arr.del','arr_parts_del','Kasuje części które przyszły');
	 
?>
