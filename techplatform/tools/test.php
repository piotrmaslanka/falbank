<?php
	/**
	 * Makeshift test file
	 * 
	 * 
	 * @author Piotr Maślanka
	 * @version 1.0
	 * @package techplatform
	 * @subpackage tools 
	 */
	 
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	 
	include_once('../libtechplatform.php');
	
	$tst = new APIDatabase('localhost','root','root');
	$tst->connect();
	$tst->selectDatabase('techplatform');
	$haslo = 'bambram333';
	$res = mysql_query('SELECT SHA1("bambram333")="'.sha1($haslo).'"');
	var_dump(mysql_fetch_array($res, MYSQL_ASSOC));
	echo($tpl->render());
	
?>