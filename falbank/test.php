<?php
	include_once('includes/bootstrap.php');
	include_once('generators/order_parts/generator.php');
	
	$cc = new DBZgloszenie($db); $cc->__load(1);
	$cp = new DBZgloszenieGwarancyjne($db); $cc->__load($cc->fk_zgl_gwara);
	
	echo(generateOrder(true,$cc, $cp));
?>
