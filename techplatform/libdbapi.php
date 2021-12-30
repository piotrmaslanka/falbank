<?php
	/**
	 * 	libdbapi
	 * 	
	 *  Database API
	 * 
	 * @author Piotr Maślanka
	 * @package techplatform
	 *  */
	 
/** 
 * Database interface class
 * @package techplatform
 * @subpackage libdbapi
 */	
define('STUPEFY_LOGS','/var/www/html/techplatform/log.txt');	 
define('QUERY_LOGS','/var/www/html/techplatform/qlog.txt');
class APIDatabase extends LastErrorImplementation
{
	/**
	 * Current database name
	 * @var string
	 */
	public $current_db = '';
	/**
	 * Checks whether given-ID record exists
	 * @param string $table nazwa tabeli
	 * @param int $id ID rekordu
	 */
	function exists($table, $id)
	{
		$res = $this->query("SELECT count(id) FROM $table WHERE id=%s",array($id));
		return (getRows($res) != 0);
	}
	static function qlogify($err)
	{
		return true;	// nothing here, move on
		$file = fopen(QUERY_LOGS,"a");
		fwrite($file, $err."\n");
		fclose($file);
	}
	static function logify($err)
	{
		return true;	// nothing here, move on
		$file = fopen(STUPEFY_LOGS,"a");
		fwrite($file, $err."\n");
		fclose($file);
	}
	static function svNow()
	{
		return '!!!!!!!!NOW()';
	}
	static function svNull()
	{
		return '!!!!!!!!NULL';
	}
	static function translatef($val)
	{
		$specials = array('!!!!!!!!NOW()' => 'NOW()','!!!!!!!!NULL' => 'NULL');
		if (array_key_exists($val, $specials))
		{
			return $specials[$val];
		} else
		{
			return '"'.mysql_real_escape_string($val).'"';
		}
	}
	/**
	 * Gets fields of a table
	 * @param string $table name of the table
	 * @return array|bool contains field names or false if failed
	 */
	function getFields($table)
	{
		$res = $this->query("SHOW COLUMNS FROM $table");
		APIDatabase::qlogify("SHOW COLUMNS FROM $table");
		if (!$res)
		{
			$this->setLastError(mysql_error($this->dbres));
			APIDatabase::logify(mysql_error()." on query SHOW COLUMNS FROM $table");
			return false;
		}
		$temp = array();
		while($row = $this->toArray($res))
		{
			$temp[] = $row['Field'];
		}
		return $temp;
	}
	/**
	 * Constructor. Just saves given data
	 * @param string $host Host address
	 * @param string $user User name
	 * @param string $pass password
	 */
	function __construct($host, $user, $pass)
	{
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
	}
	/**
	 * Connects with the database
	 * @return bool success
	 */
	function connect()
	{
		$this->dbres = mysql_connect($this->host, $this->user, $this->pass, true);
		$this->ready = (bool)$this->dbres;
		$this->setLastError(($this->ready ? '' : mysql_error()));

		mysql_query("SET NAMES 'utf8'", $this->dbres);
		mysql_query("SET CHARACTER SET 'utf8'",$this->dbres);
		mysql_query("SET COLLATION utf8_unicode_ci",$this->dbres);
		
		mysql_query('SET character_set_client = utf8;',$this->dbres);
		mysql_query('SET character_set_results = utf8;',$this->dbres);
		mysql_query('SET character_set_connection = utf8;',$this->dbres);
		mysql_query('SET character_set_database=utf8;',$this->dbres);
		mysql_query('SET character_set_server=utf8;',$this->dbres);
		
	//$res = mysql_query("SHOW VARIABLES LIKE 'character_set%'",$this->dbres);
//	while ($row = mysql_fetch_row($res)) var_dump($row);		
		return $this->ready; 		
	}
	/** 
	 * Gets row counts from query result
	 * @param resource $res Query result
	 * @return int Row count
	 */
	function getRows($res)
	{
		return mysql_num_rows($res);
	}
	/**
	 * Returns last inserted ID
	 * @return int ID
	 */
	function lastInsertId()
	{
		return mysql_insert_id($this->dbres);
	}
	/** 
	 * Updates given table
	 * @param string $table table name
	 * @param array $array hasharray field_name => field_value (just pure data)
	 * @param string $where SQL condition for update. With quotes and escapes
	 * @return bool success
	 */
	function updateArray($table, $karray, $where)
	{
		  $vals = array();
		    $q = array();
			foreach ($karray as $k=>&$v)
			{
				$karray[$k] = APIDatabase::translatef($v);
				$q[] = $k.'='.$karray[$k].'';
			}
	    $sql = "UPDATE $table SET ".implode(',', $q)." WHERE $where";
		APIDatabase::qlogify($sql);
			    if (!mysql_query($sql,$this->dbres))
	    {
	    	$this->setLastError(mysql_error());
		APIDatabase::logify(mysql_error()." on query ".$sql);
	    	return false;
	    } else return true;
	}
	/**
	 * Updates given table by row's id
	 * @param string $table table name
	 * @param array $array hash table field_name => field_value (just pure data)
	 * @param int $id record ID
	 * @return bool success
	 */
	function updateArrayID($table, $array, $id)
	{
		$this->updateArray($table, $array, 'id="'.mysql_real_escape_string($id).'"');
	}
	/** 
	 * Inserts new row into a table
	 * @param string $table table name
	 * @param array $array hashtable field_name => field_value (just pure data)
	 * @return bool success
	 */
	function insertArray($table, $array)
	{
	    $keys = array_keys($array);
	    $values = array_values($array);
		$vals = array();
		foreach ($values as $v)
		{
			$vals[] = APIDatabase::translatef($v);
		}	   
		$values = $vals;
	    $sql = 'INSERT INTO ' . $table. '(' . implode(',', $keys) . ') VALUES (' . implode(',', $values) . ')';
		APIDatabase::qlogify($sql);
	    if (!mysql_query($sql,$this->dbres))
	    {
	    	$this->setLastError(mysql_error());
		APIDatabase::logify(mysql_error() . " on query " . $sql);
	    	return false;
	    } else return true;
	}
	/**
	 * Grabs next row from a query result, or false when no more rows
	 * @param resource $query_result query result
	 * @return array|bool query row or false if no more 
	 */
	function toArray($query_result)
	{
		return mysql_fetch_array($query_result, MYSQL_ASSOC);
	}
	/** 
	 * Executes a query
	 * @param string $query a query with %s set in places where data with quotes and escapes is to be subsituted
	 * @param array $params pure data ordered in order %s will be substituted
	 * @return bool success
	 */
	function query($query, $params=array())
	{
		foreach ($params as $param)
		{
			$pos = strpos($query, '%s');
			$query = substr_replace($query, $this->translatef($param), $pos, 2);
		}
		APIDatabase::qlogify($query);
		$res = mysql_query($query, $this->dbres);
		if (!$res) 
		{
			$this->setLastError(mysql_error());
			APIDatabase::logify(mysql_error()." on query ".$query);
			return false;
		} else return $res;
	}
	/**
	 * Changes database
	 * @param string $dbanem database name
	 * @return bool success
	 */
	function selectDatabase($dbname)
	{
		$res = mysql_select_db($dbname,$this->dbres);
		if (!$res)
		{
			$this->setLastError(mysql_error());
			return false;
		} else 
		{
			$this->current_db = $dbname;
			return true;
		}
	}
}



/**
 * Base class for data access. Abstracts database rows.
 * Access to fields available. Fields are created as properties.
 * Optimizes writebacks.
 * 
 * @package techplatform
 * @subpackage libdbapi
 */
class APIDBObject extends LastErrorImplementation
{
	/**
	 * Current database link
	 * @var resource
	 */
	public $__db = null;
	/**
	 * Stores fields applicable to the table
	 * @var array
	 */
	protected $__fields = array();
	/**
	 * Stores row data
	 * @var array
	 */
	protected $__data = array();
	/** 
	 * Stores information of dirtiness of the fields (whether were they written).
	 * For optimization of writebacks
	 * @var array
	 */
	protected $__dirty = array();
	/**
	 * Stores current table name
	 * @var string
	 */
	protected $__table = '';

	function __get($name)
	{
		return $this->__data[$name];
	}
	function __set($name, $value)
	{
		if (in_array($name, $this->__fields))
		{
			$this->__dirty[$name] = true;
			$this->__data[$name] = $value;
		}
	}	
	/**
	 * Generic constructor. To be always called by the child.
	 * The child is expected to supply information on table layout with protected $__fields variable and table name with $__table.
	 * That's because of pure performance concern(to avoid a SHOW COLUMNS query).
	 * If it cannot, it should pass the table name to the constructor
	 * @param resource $dbh database link
	 * @param string $table table name
	 */
	function __construct($dbh, $table=null)
	{
		$this->__db = $dbh;
		if (!($table===null))
		{
			$this->__fields = $this->__db->getFields($table);
			$this->__table = $table;
		} 
	}
	/**
	 * Creates a given field and loads it. 
	 * Children are encouraged to provide own __create() methods with parameters
	 * that will describe fields.
	 * @param array $data data. field_name => field_value (just pure data)
	 */
	function __create($data)
	{
		$this->__db->insertArray($this->__table, $data);
		$this->__load($this->__db->lastInsertId());
	}
	/**
	 * Stores the current row in the database
	 * @return bool success
	 */
	function __store()
	{
		$wbq = array();
		foreach ($this->__fields as $fieldname)	$wbq[$fieldname] = $this->__data[$fieldname];
			if (!$this->__db->updateArrayID($this->__table, $wbq, $this->__data['id']))
		{ 
			$this->copyLastError($this->__db);
			return false;
		}
		foreach ($this->__dirty as $dk=>$dv) $this->__dirty[$dk] = false;
		return true;
	}
	/**
	 * Loads a row by it's id
	 * @param int $id row ID
	 * @return bool success
	 */
	function __load($id)
	{
		APIDatabase::qlogify("SELECT * FROM $this->__table WHERE id=$id");
		$res = $this->__db->query("SELECT * FROM $this->__table WHERE id=%s",array($id));
		if (!$res)
		{
			$this->copyLastError($this->__db);
			return false;
		}
		if ($this->__db->getRows($res)==0)
		{
			$this->setLastError("APIDBObject: __load(): could not find given record");
			return false;
		}
		$row = $this->__db->toArray($res);
		foreach ($this->__fields as $field)
		{
			$this->__data[$field] = $row[$field];
			$this->__dirty[$field] = false;
		}
		return true;
	}
	/**
	 * Removes a row as it is loaded. Destroys class properties.
	 * @return bool success
	 */
	function __delete()
	{
		APIDatabase::qlogify("DELETE FROM ".$this->__table." WHERE id=".$this->id);
		return $this->__db->query("DELETE FROM $this->__table WHERE id=%s",array($this->id));
	}
}
?>
