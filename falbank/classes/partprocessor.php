<?php
/**
 * Statyczna klasa dla przetwarzania zamówień i części
 */
class Partprocessor
{
	/**
	 * Zwraca stan magazynu. O kuźwa.
	 */
	/**
	 * Zwraca nazwę części po numerze katalogowym
	 * @param string $nrkata numer katalogowy
	 * @return string nazwa
	 */
	static function getPartName($nrkata)
	{
		global $db;
		$res = $db->query('SELECT nazwa FROM CzesciZamawiane WHERE nrkata=%s',array($nrkata));
		$row = $db->toArray($res);
		
		if (!$row['nazwa'])
		{
			$res = $db->query('SELECT nazwa FROM CzesciPrzyjete WHERE nrkata=%s',array($nrkata));
			$row = $db->toArray($res);
		}
		
		return $row['nazwa'];
	}
	/**
	 * Zwraca globalny profil części. Cholera naprawdę nie wiem co to robi.
	 * Chyba jest używane do sprawdzenia czy wszystko doszło do zamówienia.
	 * @return array array(hasharray nrkata=>iloscczesci, status(0 - wszystko zrobione, 1 - niektore nie doszly, 2 - nic nie zamawialismy))
	 */
	static function getGlobalPartsProfile()
	{
		global $db;
		$res = $db->query('SELECT ilosc,nrkata FROM CzesciZamawiane',array());
		$przy = array();		// hashtabela. Czesci przyjete - ile jest
		while ($row = $db->toArray($res)) 
		{
			$przy[$row['nrkata']] -= $row['ilosc'];	
		}
		$res = $db->query('SELECT ilosc, nrkata FROM CzesciPrzyjete',array());
		while ($row = $db->toArray($res))
		{
			$przy[$row['nrkata']] += $row['ilosc'];
		}
		
		return $przy;		
	}
	/**
	 * Zwraca profil analizy danego zamówienia pod kątem przyjścia części
	 * @param integer $zid Id zamówienia
	 * @return array array(hasharray nrkata=>iloscczesci, status(0 - wszystko zrobione, 1 - niektore nie doszly, 2 - nic nie zamawialismy))
	 */
	static function getPartsProfile($zid)
	{
		global $db;
		$res = $db->query('SELECT ilosc,nrkata FROM CzesciZamawiane WHERE fk_nrZam=%s',array($zid));
		$przy = array();		// hashtabela. Czesci przyjete - ile jest
		$zamawialismy_cos = false; 
		while ($row = $db->toArray($res)) 
		{
			$zamawialismy_cos = true;
			$przy[$row['nrkata']] -= $row['ilosc'];	
		}
		$res = $db->query('SELECT ilosc, nrkata FROM CzesciPrzyjete WHERE fk_nrZam=%s',array($zid));
		while ($row = $db->toArray($res))
		{
			$przy[$row['nrkata']] += $row['ilosc'];
		}
		$wd = 0;
		
		if (!$zamawialismy_cos) return array($przy,2);
		foreach ($przy as $k=>$v) if ($v < 0) {$wd = 1; break;}
		return array($przy, $wd);
	}
}
?>
