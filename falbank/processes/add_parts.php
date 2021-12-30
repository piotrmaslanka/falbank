<?php
/*
 * Części dopisywane do protokołu
 */
 function add_parts_add(&$parent, $params)
 {
 	list($posts) = $params;
 	global $db;
 	$xx = new DBCzesciDoProtokolu($db);
 	$xx->__create(trim($posts['nrkata']),trim($posts['fk_nrZam']));
 }
 
 function add_parts_del(&$parent, $params)
 {
 	list($xx) = $params;
 	$xx->__delete();
 }
 
 	EventManager::addHook('parts.add.add','add_parts_add','Dopisuje części do protokołu');
 	EventManager::addHook('parts.add.del','add_parts_del','Odpisuje części do protokołu');
?>
