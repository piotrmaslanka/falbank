<?php
/*
 * Sprawdzenia części dopisywanych do protokołu
 */
 
function check_add_parts_add(&$parent, $params)
{
	global $db;
	list($posts) = $params;
	$cc = new DBZgloszenie($db);
	if (!$cc->__load($posts['fk_nrZam'])) $parent->signalError('addparts.wrongzamowienie');
	if (!$posts['fk_nrZam']) $parent->signalError('form.incomplete');
	if (!$posts['nrkata']) $parent->signalError('form.incomplete');
} 

function check_add_parts_del(&$parent, $params)
{
	
}
 
 
EventManager::addHook('check.parts.add.add','check_add_parts_add','Dopisuje części do protokołu');
EventManager::addHook('check.parts.add.del','check_add_parts_del','Odpisuje części do protokołu');
 
?>
