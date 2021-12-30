<?php
	/**
	 * Send
	 * 
	 * Wysyłanie dokumentów
	 */
	 
	/**
	 * Sprawdza czy lista części danego zgłoszenia może być wysłana
     * @param array $params array(DBZgloszenie, DBZgloszenieGwarancyjne)
	 */	
	function order_list_send(&$parent, $params)
	{
		global $usr;
		list($cc, $cp) = $params;
		$server = new SMTPServer($usr->registry['Falbank']['Settings']['smtphostname'],
								 $usr->registry['Falbank']['Settings']['smtpusername'],
								 $usr->registry['Falbank']['Settings']['smtppassword']);
		if (!$server->connect()) { echo 'Nie nawiazalem polaczenia'; $parent->signalError('failed'); return; }
		
		foreach(explode(';',$usr->registry['Falbank']['Settings']['smtprecipients']) as $address)
		{
			$msg = new SMTPMail($usr->registry['Falbank']['Settings']['smtpmyaddress'],$address,
			'Zamówienie części', $usr->registry['Falbank']['Settings']['smtpfriendlyname']);
			
			$msg->setContent('Zamowienie nr '.$cc->id);
			$msg->addAttachment(file_get_contents(generateOrder(false,$cc,$cp)),'Zamowienie nr '.$cc->id.'.pdf','','application/pdf');
			if (!$server->send($msg)) { echo 'Nie wyslalem wiadomosci'; $parent->signalError('failed'); return; }
		}
			$server->disconnect();
		$cp->wyslano_liste_czesci = time();
		$cp->__store();
	}
	
	EventManager::addHook('order_list.send','order_list_send','Wysyła zamówienie na części');
?>
