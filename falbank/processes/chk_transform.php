<?php
	/**
	 * transform
	 * 
	 * Sprawdzanie dla transform
	 */
	 
	 /**
	  * Sprawdza transform na gwarancyjne
	  * @param array $params array(DBZgloszenie)
	  */
	 function chk_transform_toWarranty(&$parent, $params)
	 {
	 	list($cc) = $params;
	 	if ($cc->gwarancyjna == 1) $parent->signalError('transform.already');
	 }

	EventManager::addHook('check.zgloszenie.toWarranty','chk_transform_toWarranty','Sprawdza poprawność przed zmianą w zgłoszenie gwarancyjne');
?>
