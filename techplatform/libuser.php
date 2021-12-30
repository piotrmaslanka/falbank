<?php
	/**
	 * libuser
	 * 
	 * Library for user handling
	 * 
	 * @package techplatform
	 * @author Piotr Maślanka
	 */
	 
/**
 * Class representing a single user/service
 * @package techplatform
 */	 
class APIUser extends LastErrorImplementation
{
	/** 
	 * Checks if is a service
	 * @return bool is a service
	 */
	function isService() { return ($this->type === 1); }
	/**
	 * Checks if is a user
	 * @return bool is a user
	 */
	function isUser() {	return ($this->type === 0); }
	/**
	 * Stores the user and prepares the class for destruction
	 */
	function logout()
	{
		$this->storeRegistry();
		unset($this->username); unset($this->password); unset($this->id); unset($this->type);
	}
	/**
	 * Forcibly initiates the class with user/service id
	 * @param int $id user/service id
	 * @return bool success
	 */
	function createForceId($id)						// forces creation by ID
	{
		global $tpInternal;
		$res = $tpInternal['db']->query("SELECT username, token, type FROM tpusers WHERE (id=%s)", array($id));
		if (!$res) 
		{
			$this->copyLastError($tpInternal['db']);
			return false;
		}
		if ($tpInternal['db']->getRows($res)==0)
		{
			$this->lasterror = 'Wrong user';
			return false;
		}
		$row = $tpInternal['db']->toArray($res);
		$this->username = $row['username'];
		$this->token = $row['token'];
		$this->id = $id;
		$this->type = (int)$row['type'];
		return true;				
	}
	/**
	 * Forcibly initiates the class with user/service login
	 * @param string $username user/service login
	 * @return bool success
	 */
	function createForce($username)					// forces creation by username
	{
		global $tpInternal;
		$res = $tpInternal['db']->query("SELECT id, token, type FROM tpusers WHERE (username=%s)", array($username));
		if (!$res) 
		{
			$this->copyLastError($tpInternal['db']);
			return false;
		}
		if ($tpInternal['db']->getRows($res)==0)
		{
			$this->lasterror = 'Wrong user';
			return false;
		}
		$row = $tpInternal['db']->toArray($res);
		$this->username = $username;
		$this->token = $row['token'];
		$this->id = $row['id'];
		$this->type = (int)$row['type'];
		return true;		
	}
	/**
	 * Initiates the class with user/service based on authentication
	 * @param string $username user/service login
	 * @param string $password user/service password
	 * @return bool success
	 */
	function createByLogin($username, $password)			// creates by authentication
	{
		if ($username == 'techplatform') return false;
		global $tpInternal;	
		$res = $tpInternal['db']->query("SELECT id, token, type FROM tpusers WHERE (username=%s) AND (password=SHA1(%s))", array($username, $password));
		if (!$res) 
		{
			$this->copyLastError($tpInternal['db']);
			return false;
		}
		if ($tpInternal['db']->getRows($res)==0)
		{
			$this->lasterror = 'Wrong user or password';
			return false;
		}
		$row = $tpInternal['db']->toArray($res);
		$this->username = $username;
		$this->token = $row['token'];
		$this->password = $password;
		$this->id = $row['id'];
		$this->type = (int)$row['type'];
		return true;
	}
	/**
	 * Writes back user/service registry to database
	 * @return bool success
	 */
	function storeRegistry()
	{
		if (empty($this->id))
		{
			$this->setLastError('Class does not contain a logged-in user');
			return false;
		}
		
		$reg = $this->registry;
		
		$licenses = serialize($reg['Licenses']);
		$privileges = serialize($reg['Privileges']);
		unset($reg['Licenses']);
		unset($reg['Privileges']);
		$registry = serialize($reg);
		
		global $tpInternal;
		if (!$tpInternal['db']->updateArray('tpusers',array('registry'=>$registry,
												       'licenses'=>$licenses,
													   'privileges'=>$privileges), 'id="'.$this->id.'"'))
		{
			$this->copyLastError($tpInternal['db']);
			return false;											   	
		}
		return true;
		
	}
	/**
	 * Loads user/service registry from database
	 * @return bool success
	 */
	function loadRegistry()
	{
		if (empty($this->id)) 
		{
			$this->setLastError('Class does not contain a logged-in user');
			return false;
		}
		global $tpInternal;
		
		$this->registry = array();
		$res = $tpInternal['db']->query("SELECT registry, privileges, licenses FROM tpusers WHERE id=%s", array($this->id));
		$row = $tpInternal['db']->toArray($res);
		$this->registry = unserialize($row['registry']);
		$this->registry['Privileges'] = unserialize($row['privileges']);
		$this->registry['Licenses'] = unserialize($row['licenses']);
		return true;
	}
}
?>