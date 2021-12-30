<?php

	/**
	 * Dodaje nowe uruchomienie
	 * @param EventInstance &$parent EventInstance rodzic
	 * @param array $params array(lista POST)
	 */
	function uruchomienie_add(&$parent, $params)
	{
		global $db;
		list($posts) = $params;
		$uu = new DBUruchomienia($db);
		$uu->__create($posts['nazwa'],
					trim($posts['typurzadzenia']), 
					$posts['ktouruch'],
					strtotime($posts['datauruch']), 
					(empty($posts['dataostr']) 
	 							? APIDatabase::svNull()
	 							: strtotime($posts['dataostr'])),
	 				$posts['uwagi'],
	 				$posts['ulica'],
	 				$posts['kodmiejscowosc']
					);
	}
	
	/**
	 * @param $params array(DBUruchomienia, $_POST) 
	 */
	function uruchomienie_modify(&$parent, $params)
	{
		list($uu, $posts) = $params;
		$uu->nazwa = $posts['nazwa'];
		$uu->typurzadzenia = trim($posts['typurzadzenia']);
		$uu->ktouruch = $posts['ktouruch'];
		$uu->uwagi = $posts['uwagi'];
		$uu->ulica = $posts['ulica'];
		$uu->kodmiejscowosc = $posts['kodmiejscowosc'];
		$uu->datauruch = strtotime($posts['datauruch']);
		$uu->dataostr = (empty($posts['dataostr']) 
	 							? APIDatabase::svNull()
	 							: strtotime($posts['dataostr']));
	 	$uu->__store();
	}
	
	/**
	 * @param $params array(DBUruchomienia)
	 */
	function uruchomienie_remove(&$parent, $params)
	{
		list($uu) = $params;
		$uu->__delete();
	} 
	
	EventManager::addHook('uruchomienie.add','uruchomienie_add','Dodaje uruchomienie');
	EventManager::addHook('uruchomienie.modify','uruchomienie_modify','Modyfikuje uruchomienie');
	EventManager::addHook('uruchomienie.remove','uruchomienie_remove','Kasuje uruchomienie');
?>