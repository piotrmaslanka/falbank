<?php
/**
* Essentially dumps data from given table, giving no clue as that the schema is
* Useful in conjunction with cron/wget database backups(my clients do that)
* Forces UTF-8 everywhere. If you don't use it already, consider USING IT.
* Have fun!
*
* @author Henrietta <squerart_web@interia.pl>
* @license http://www.gnu.org/licenses/lgpl-3.0.html
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
mysql_query("SET NAMES 'utf8'", $this->connection);
mysql_query("SET CHARACTER SET 'utf8'",$this->connection);
mysql_query("SET COLLATION utf8_unicode_ci",$this->connection);
return true;
}
/**
* Dumps a given table
* @return string SQL query with data
*/
function dump_data($table)
{
$res = mysql_query("SELECT * FROM $table",$this->connection);
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
$res = @mysql_query('SHOW TABLES',$this->connection) or die("Failed SHOW TABLES: ".mysql_error());
$tbs = array();
while ($row = mysql_fetch_row($res)) $tbs[] = $row[0];
return $tbs;
}
}
 
header('Content-type: application/octet-stream; encoding="utf-8"');
header('Content-disposition: attachment; filename=backup.sql');
 
$myk = new MYSQLDatabaseDump();
$myk->connect('localhost','root','password','dms_falbank');
$tb = $myk->getTables();
$sql = '-- made on '.date('Y-m-d H:i:s')."\n";
foreach ($tb as $tn)
{
$sql .= '-- dumping '.$tn.' --'."\n";
$sql .= $myk->dump_data($tn)."\n";
}
echo $sql;
?>
