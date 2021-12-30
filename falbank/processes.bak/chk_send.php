<?php
	/**
	 * Send
	 * 
	 * Sprawdzarki dla wysyłania dokumentów
	 */
	 
	 /**
	  * Sprawdza czy lista części danego zgłoszenia może być wysłana
	  * @param array $params array(DBZgloszenie, DBZgloszenieGwarancyjne)
	  */	 
	 function chk_order_list_send(&$parent, $params)
	 {
	 	list($cc, $cp) = $params;
	// dostepne: form.incomplete
	 }
	 
	 EventManager::addHook('check.order_list.send','chk_order_list_send','Sprawdza czy zamówienie części może zostać wysłane');
?>
