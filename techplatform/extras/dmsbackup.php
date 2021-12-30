<?php
	include_once('techplatform/extras/libdbdump.php');
	
	header('Content-type: text/plain encoding="utf-8"');
	
	$myk = new MYSQLDatabaseDump();
	$myk->connect('localhost','dms','dmszdxZDX','dms_forum');
	$tb = $myk->getTables();
	$sql = '';
	foreach ($tb as $tn)
	{
		$sql .= '-- dumping '.$tn.' --'."\n";
		$sql .= $myk->dump_data($tn)."\n";
	}
	echo $sql;
?>