<?php
	/**
	 * libevents
	 * 
	 * Event managers and event classes
	 * 
	 * @package techplatform
	 */
	 
/**
 * Single instance of event. Create it passing its name and array of parameters to the constructor. The object will contain 
 * all the required data within itself. Reads event hooks from static event manager.
 */
class EventInstance
{
	/**
	 * Event name
	 * @var string
	 */
	public $eventname = '';
	/**
	 * Error message
	 * @var string
	 */
	public $errmsg = '';
	/**
	 * Whether a handler has requested to abort the action
	 * @var string
	 */
	public $needabort = false;
	/**
	 * Constructor. Signals the event.
	 * @param string $name event name
	 */ 
	function __construct($name, $params)
	{
		$this->eventname = $name;
		$handlerlist = EventManager::$eventhooks[$name];
		foreach ($handlerlist as $handler)
		{
			$handler($this, $params);
			if ($this->needabort) break;
		}			
	}
	/**
	 * Signals an error - sets error message and sets action to abort. Further actions will not be executed
	 * @param string $errname error message
	 */
	 function signalError($errname)
	 {
	 	$this->errmsg = $errname;
	 	$this->needabort = true;
	 }
	 /**
	  * Checks whether the operation was aborted
	  * @return bool whether was aborted
	  */
	 function wasStopped()
	 {
	 	return ($this->needabort);
	 }
	 /**
	  * Gets error message
	  * @return string error message
	  */
	 function getErrMsg()
	 {
	 	return $this->errmsg;
	 }
}
/**
 * Static event manager class
 */	 
 class EventManager
 {
 	/**
 	 * Hash array of event names/comments
 	 * @var array
 	 */
 	static public $eventcomments = array();
 	/**
 	 * Hash array of event names/procedure names
 	 * @var array
 	 */
 	static public $eventhooks = array();
	/** 
	 * Adds a hook
	 * @param string $hookname hook name
	 * @param callback $handler handle name
	 */ 
	static function addHook($hookname, $handler, $comment='')
	{
		sapKey($hookname, $handler, self::$eventhooks);
		sapKey($hookname, $comment, self::$eventcomments);
	} 
 }
?>