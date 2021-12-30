<?php
	/**
	 * 	stdlib
	 * 	
	 * Techplatform standard library
	 * Contains mostly syntactic sugar
	 * 
	 * @author Piotr Maślanka
	 * @package techplatform
	 *  */
/**
 * A class for getting stuff about current techplatform version
 * @package techplatform
 */
class APITechplatform
{
	static function getVersion() { return '1.0'; }
	static function getFullName() { return 'techplatform-1.0-development'; }
	static function getPrevBranch() { return 'main'; }
	static function getBranch() { return 'falbank'; }
	static function getComponents()
	{
		return array(
		'dbapi' => 'mysql-1.0',
		'smtp' => 'smtp-1.0',
		'template' => 'tapl+phpapl-1.0',
		);
	}
}
/**
 * 	Base class implementing last error reporting and passing
 * 
 * @package techplatform
 */	 
class LastErrorImplementation
{
	public $lasterror = '';
	/**
	 * Sets new error message
	 * @param string $str new error message
	 */
	function setLastError($str)
	{
		$this->lasterror = $str;
	}
	/**
	 * Returns current error message
	 * @return string error message
	 */
	function getLastError()
	{
		return $this->lasterror;
	}
	/**
	 * Copies error message from other LastErrorImplementation instance
	 * @param LastErrorImplementation $LEIClass source instance
	 */
	function copyLastError(LastErrorImplementation $LEIClass)
	{
		$this->lasterror = $LEIClass->lasterror;
	}
}

/**
 * Performs HTTP header redirection under given address and kills the script
 * @param string $target URL or filename
 */
function Location($target)
{
	header("Location: $target"); 
	die();
}
/**
 * Encodes stuff in quoted_printable encoding
 * @param string $string string to be encoded
 * @return string encoded string
 */	 	 
/*function quoted_printable_encode($string) {
    return preg_replace('/[^\r\n]{73}[^=\r\n]{2}/', "$0=\r\n",
      str_replace("%", "=", str_replace("%0D%0A", "\r\n",
        str_replace("%20"," ",rawurlencode($string))))); 	 }*/
/**
 * Performs in-place str_replace 
 * @param string $search stuff to search
 * @param string $replace stuff to replace
 * @param string $value string to be worked upon
 */	 	 
 function estr_replace($search, $replace, &$value)
 {
 	$value = str_replace($search, $replace, $value);
 }
 /**
  * Given a hash table whose values are arrays if given key exists in the table:
  * 	if exists, value will be appended to key's value array
  * 	if doesn't, an array with single element - value - will be created as value for key
  * @param mixed $key key
  * @param mixed $value value
  * @param array $array target array 
  */
 function sapKey($key, $value, &$array)
 {
 	if (empty($array[$key])) $array[$key] = array($value); else $array[$key][] = $value;
 }
 /** 
  * Flattens an array
  * @param array $a array to be flattened
  * @return array flattened version of the array
  */
 function array_flatten(array $a)
 {
	$i = 0;
	while ($i < count($a)) 
	{
		if (is_array($a[$i])) 
		{
			array_splice($a, $i, 1, $a[$i]);
		} else 
		{
			$i++;
		}
	}
	return $a;
}
/**
 * Flattens an array in-place
 * @param array $a array to be flattened
 */
function qarray_flatten(array &$a)
{
	$a = array_flatten($a);
}

/**
 * Performs a preg_match_all returning all the matches as an array
 * @param string $regexp a PCRE string
 * @param string $object object to perform preg_match_all upon
 * @return array array of preg_matches
 */
function apreg_match($regexp, $object)
{
	$matchlist = array();
	preg_match_all($regexp, $object, $matchlist);
	return $matchlist;
}
/**
 * Formats timestamp to an acceptable format
 * @param int $ts timestamp
 * @return string string format
 */
function sqlts($ts)
{
	return date('Y-m-d H:i:s', $ts);
}
?>
