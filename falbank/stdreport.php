<?php
	include_once('includes/bootstrap.php');
	include_once('generators/standard_report/generator.php');
	include_once('generators/service_report/generator.php');
	
	if (empty($_GET['id'])) Location('index.php');
	
	$cc = new DBZgloszenie($db);
	if (!$cc->__load($_GET['id'])) Location('index.php');
	
	if ($cc->gwarancyjna == 0)
	{
		echo(generateReport($cc));
	} else
	{
		$cd = new DBZgloszenieGwarancyjne($db);
		$cd->__load($cc->fk_zgl_gwara);		
		echo(generateWarrantyReport($cc, $cd));		
	}
?>