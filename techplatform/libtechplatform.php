<?php
/**
 * libtechplatform
 * 
 * Primary include file for techplatform. Include it to access Techplatform primary interface
 * 
 * @package techplatform
 * @author Piotr Maślanka
 */
	include_once('stdlib.php');

	include_once('config.php');
	include_once('libdbapi.php');

/**
 * Returns a database link established from a config-specified database with already selected database from config
 * @return APIDatabase database link
 */	
function tpiSpawnDatabase()			
{
	global $techplatform_registry;
	$db =  new APIDatabase($techplatform_registry['database_host'],
						   $techplatform_registry['database_user'],
						   $techplatform_registry['database_pass']);
	$db->connect();
	$db->selectDatabase($techplatform_registry['database_dbase']);
	return $db;					
}	
	
	$tpInternal = array();
	$tpInternal['db'] = tpiSpawnDatabase();

	include_once('libuser.php');
	include_once('libsession.php');
	include_once('libiniapis.php');
	include_once('libusermanagement.php');
	include_once('libsmtp.php');
	include_once('libtemplate.php');	include_once('phpaplruntime.php');
	include_once('libevents.php');
	
		/* more-less now, what's exposed to user:
		 * 	libdbapi:
		 * 		class APIDatabase
		 * 		class APIDBObject
		 *  class APIUser
		 *  class APISession
		 *  class APILanguage
		 *  class APIGraphics
		 *  class APIUserManagement
		 * 	libsmtp:
		 * 		class SMTPServer
		 * 		class SMTPMail
		 *  stdlib.php
		 */
	
	
?>
