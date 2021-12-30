<?php
/**
 * libsession
 * 
 * Faciliates session management
 * 
 * @package techplatform
 */
 
/**
 * Static class for session management
 * @package techplatform
 */
class APISession
{
	/** 
	 * Starts session support and other stuff
	 */
	static function start()
	{
		session_start();
		ob_start();
	}
	/**
	 * Logs an issue into the system log
	 * @param string $servicename reporting service's name
	 * @param string $reason log message
	 * @param int $severity error severity. The lower, the more severe
	 * @return bool success
	 */
	static function logIssue($servicename, $reason, $severity=5)
	{
		global $tpInternal;
		$tpInternal['db']->insertArray('tplogs', array(
								'service' => $servicename,
								'text' => $reason,
								'severity' => $severity,
								'when' => APIDatabase::svNow()
								));
		return true;
	}
	
	/**
	 * Sets a APIUser as this session's logged user
	 * @param APIUser $user user class
	 * @return bool succcess
	 */
	static function loginUser(APIUser $user)
	{
		$_SESSION['user'] = $user;
		$_SESSION['logged'] = true;
		return true;
	}
	/**
	 * Logs current logged user out
	 */
	static function logoutUser()
	{
		if ($_SESSION['user']->isUser())
		{
			$_SESSION['user']->logout();			// invalidate the class in case references existed
			unset($_SESSION['user']);				// and get rid of our reference
		}
		$_SESSION['logged'] = false;
	}
	/**
	 * Checks whether an user is logged in
	 * @return bool is logged
	 */
	static function isLogged()
	{
		return ($_SESSION['logged']==true);
	}
}
?>
