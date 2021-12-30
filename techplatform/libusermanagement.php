<?php
	/**
	 * libusermanagement
	 * 
	 * faciliates managing users
	 * 
	 * @author Piotr Maślanka
	 * @package techplatform
	 */
/**
 * Static class for user management
 * @package techplatform
 */
class APIUserManagement
{
	/**
	 * Returns user login by its ID.
	 * @param int $id user ID
	 * @return string, bool Username or FALSE on none
	 */
	static function getAccountUsername($id)
	{
		global $tpInternal;
		$res = $tpInternal['db']->query("SELECT username FROM tpusers WHERE id=%s",array($id));
		if (!$res) return false;
		$row = $tpInternal['db']->toArray($res);
		if ($tpInternal['db']->getRows($res) == 0) return false;
		return $row['username'];		
	}
	/**
	 * Returns user account ID by its login name. Quite a lightweight version of libusers 
	 * creating by Username and getting ID. Besides, libuser objects may implement logging.
	 * @param string $name login name
	 * @return int, bool account ID or FALSE on none
	 */
	static function getAccountID($name)
	{
		global $tpInternal;
		$res = $tpInternal['db']->query("SELECT id FROM tpusers WHERE username=%s",array($name));
		if (!$res) return false;
		$row = $tpInternal['db']->toArray($res);
		if ($tpInternal['db']->getRows($res) == 0) return false;
		return $row['id'];
	}
	
	static private function userFactory($user, $pass, $token, $type)
	{
		global $tpInternal;
		$pass = sha1($pass);
		$res = $tpInternal['db']->insertArray('tpusers', array(
								'username'=>$user,
								'password'=>$pass,
								'token'=>$token,
								'type'=>$type
								));
		if (!$res) return false;  
		$lid = $tpInternal['db']->lastInsertId();
		return $lid;
	}
	/**
	 * checks whether a given user/service exists
	 * @param string $login user/service login
	 * @return bool whether exists
	 */
	static function userExists($login)
	{
		global $tpInternal;
		$res = $tpInternal['db']->query("SELECT id FROM tpusers WHERE username=%s", array($login));
		if (!$res) return false;
		return ($tpInternal['db']->getRows($res)==1);
	}
	/**
	 * creates a new service
	 * @param string $user service login
	 * @param string $pass service password
	 * @param string $token service token
	 * @return int service ID
	 */
	static function createService($user, $pass, $token)
	{
		return self::userFactory($user, $pass, $token, 1);
	}
	/**
	 * creates a new user
	 * @param string $user service login
	 * @param string $pass service password
	 * @param string $token service token
	 * @return int success user ID
	 */
	static function createUser($user, $pass, $token)
	{
		return self::userFactory($user, $pass, $token, 0);
	}
}
?>