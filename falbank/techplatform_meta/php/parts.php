<?php
/**
* @package falbank
* @subpackage database
***/
class DBCzesciPrzyjete extends APIDBObject
 {
 protected $__fields = array('id','data','nrdd','fk_nrZam','ilosc','nrkata','nazwa');
 protected $__table = 'CzesciPrzyjete';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($data,$nrdd,$fk_nrZam,$ilosc,$nrkata,$nazwa)
 {
  global $conf;
  parent::__create(array(
   'data' => $data,
   'nrdd' => $nrdd,
   'fk_nrZam' => $fk_nrZam,
   'ilosc' => $ilosc,
   'nrkata' => $nrkata,
   'nazwa' => $nazwa
   ));
 }
}
class DBCzesciZamawiane extends APIDBObject
 {
 protected $__fields = array('id','ilosc','nrkata','nazwa','fk_nrZam');
 protected $__table = 'CzesciZamawiane';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($ilosc,$nrkata,$nazwa,$fk_nrZam)
 {
  global $conf;
  parent::__create(array(
   'ilosc' => $ilosc,
   'nrkata' => $nrkata,
   'nazwa' => $nazwa,
   'fk_nrZam' => $fk_nrZam
   ));
 }
}
class DBCzesciDoProtokolu extends APIDBObject
 {
 protected $__fields = array('id','nrkata','fk_nrZam');
 protected $__table = 'CzesciDoProtokolu';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($nrkata,$fk_nrZam)
 {
  global $conf;
  parent::__create(array(
   'nrkata' => $nrkata,
   'fk_nrZam' => $fk_nrZam
   ));
 }
}
?>