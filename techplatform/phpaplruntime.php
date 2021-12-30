<?php
/**
 * PHPAPL runtime functions
 * @package techplatform
 * @subpackage template
 */
 

function parSVarRepl(&$code, $params)
{
//	var_dump($params);
	$matches = array();
	while ($lito = preg_match('/%(.+?)%/', $code, $matches))
	{
		$strname = substr($matches[1],1,-1);
		//$matches[0] = str_replace("/","//",$matches[0]);		
//		echo("<hr/>");
//		var_dump($matches[0]);
//		echo("<hr/>");
		$code = preg_replace('/'.$matches[0].'/', $params[$matches[1]], $code);
	}
}
?>
