<?php
	/**
	 * transform
	 * 
	 * Wykonawcze dla transform
	 */
	 
	 /**
	  * Transformuje do warranty
	  * @param array $params array(&DBZgloszenie)
	  */
	 function transform_toWarranty(&$parent, $params)
	 {
	 	global $db;
	 	list($cc) = $params;
	 	
	 	$rok = date('Y');
	 	
	 	$res = $db->query('SELECT MAX( CAST(LEFT(nrproto,LOCATE("/",nrproto)) AS UNSIGNED )) AS xnrproto FROM ZgloszenieGwarancyjne WHERE RIGHT( TRIM( nrproto ) , 4 ) =%s',array($rok));
		$row = $db->toArray($res);
		$row = $row['xnrproto']+1;
		 	
	 	$cd = new DBZgloszenieGwarancyjne($db);
	 	$cd->__create(0,
	 				  0,
	 				  $row.'/'.$rok,		//nrproto
	 				  '',	// opis
	 				  '',	// typkotla
	 				  '',	//paliwo
	 				  '','','','','','',
	 				  APIDatabase::svNull(),
	 				  '',
	 				  0,
	 				  0);
	 	$cc->gwarancyjna = 1;
	 	$cc->fk_zgl_gwara = $cd->id;
		$cc->__store();	
	 }
	 
	 EventManager::addHook('zgloszenie.toWarranty','transform_toWarranty','Zmienia w zgłoszenie gwarancyjne');
?>
