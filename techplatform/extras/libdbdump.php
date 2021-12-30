<?php
	/**
	 * libdbdump
	 * 
	 * Library for dumping libraries - aka making backups
	 * 
	 * @package techplatform
	 * @subpackage extras
	 */
/**
 * A MYSQL dump object
 */
class MYSQLDatabaseDump
{
	/**
	 * A database connection
	 * @var resource
	 */
	protected $connection = null;
	/**
	 * Connects to a database
	 * @param string $host database host
	 * @param string $user database user
	 * @param string $pass database password
	 * @param string $dbase database name
	 * @return bool was success
	 */
	function connect($host, $user, $pass, $dbase)
	{
		$this->connection = mysql_connect($host, $user, $pass);
		if (!$this->connection) return false;
		if (!mysql_select_db($dbase, $this->connection)) return false;
		return true;	
	}
	/**
	 * Dumps a given table
	 * @return string SQL query with data
	 */
	function dump_data($table)
	{
		$res = mysql_query("SELECT * FROM $table");
		$sql = '';
		while ($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$sql .= 'INSERT INTO '.$table.' ('.implode(',',array_keys($row)).') VALUES ';
			$avk = array_values($row);
			foreach ($avk as &$v) $v = '"'.mysql_real_escape_string($v).'"'; 
			$sql .= '('.implode(',',$avk).');';
			$sql .= "\n";
		}
		return $sql;
	}
	/**
	 * Lists tables in given database
	 * @return array array of table names in the database
	 */
	function getTables()
	{
		$res = mysql_query('SHOW TABLES');
		$tbs = array();
		while ($row = mysql_fetch_row($res)) $tbs[] = $row[0];
		return $tbs;	
	}
}	 
?>