<?php
/**
* @package falbank
* @subpackage database
***/
class DBUruchomienia extends APIDBObject
 {
 protected $__fields = array('id','nazwa','typurzadzenia','ktouruch','datauruch','dataostr','uwagi','ulica','kodmiejscowosc');
 protected $__table = 'Uruchomienia';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($nazwa,$typurzadzenia,$ktouruch,$datauruch,$dataostr,$uwagi,$ulica,$kodmiejscowosc)
 {
  global $conf;
  parent::__create(array(
   'nazwa' => $nazwa,
   'typurzadzenia' => $typurzadzenia,
   'ktouruch' => $ktouruch,
   'datauruch' => $datauruch,
   'dataostr' => $dataostr,
   'uwagi' => $uwagi,
   'ulica' => $ulica,
   'kodmiejscowosc' => $kodmiejscowosc
   ));
 }
}
?>