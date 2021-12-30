<?php
/**
* @package falbank
* @subpackage database
***/
class DBZgloszenie extends APIDBObject
 {
 protected $__fields = array('id','nrurzadzenia','typurzadzenia','ulica','kodmiejscowosc','telefon','przyczyna','ktonaprawil','uwagi','kiedynaprawione','kiedyzgloszone','ktoprzyjal','zrealizowana','gwarancyjna','fk_zgl_gwara','nazwa');
 protected $__table = 'Zgloszenie';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($nrurzadzenia,$typurzadzenia,$ulica,$kodmiejscowosc,$telefon,$przyczyna,$ktonaprawil,$uwagi,$kiedynaprawione,$kiedyzgloszone,$ktoprzyjal,$zrealizowana,$gwarancyjna,$fk_zgl_gwara,$nazwa)
 {
  global $conf;
  parent::__create(array(
   'nrurzadzenia' => $nrurzadzenia,
   'typurzadzenia' => $typurzadzenia,
   'ulica' => $ulica,
   'kodmiejscowosc' => $kodmiejscowosc,
   'telefon' => $telefon,
   'przyczyna' => $przyczyna,
   'ktonaprawil' => $ktonaprawil,
   'uwagi' => $uwagi,
   'kiedynaprawione' => $kiedynaprawione,
   'kiedyzgloszone' => $kiedyzgloszone,
   'ktoprzyjal' => $ktoprzyjal,
   'zrealizowana' => $zrealizowana,
   'gwarancyjna' => $gwarancyjna,
   'fk_zgl_gwara' => $fk_zgl_gwara,
   'nazwa' => $nazwa
   ));
 }
}
class DBZgloszenieGwarancyjne extends APIDBObject
 {
 protected $__fields = array('id','km','godziny','nrproto','opis','u1typ','u1paliwo','u1nrfabr','u1rokprod','u2typ','u2nrfabr','u2rokprod','datauruchom','ktouruchom','zamkniete','wyslano_liste_czesci','rozliczono');
 protected $__table = 'ZgloszenieGwarancyjne';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($km,$godziny,$nrproto,$opis,$u1typ,$u1paliwo,$u1nrfabr,$u1rokprod,$u2typ,$u2nrfabr,$u2rokprod,$datauruchom,$ktouruchom,$zamkniete,$wyslano_liste_czesci)
 {
  global $conf;
  parent::__create(array(
   'km' => $km,
   'godziny' => $godziny,
   'nrproto' => $nrproto,
   'opis' => $opis,
   'u1typ' => $u1typ,
   'u1paliwo' => $u1paliwo,
   'u1nrfabr' => $u1nrfabr,
   'u1rokprod' => $u1rokprod,
   'u2typ' => $u2typ,
   'u2nrfabr' => $u2nrfabr,
   'u2rokprod' => $u2rokprod,
   'datauruchom' => $datauruchom,
   'ktouruchom' => $ktouruchom,
   'zamkniete' => $zamkniete,
   'wyslano_liste_czesci' => $wyslano_liste_czesci,
   'rozliczono' => '0'
   ));
 }
}
?>