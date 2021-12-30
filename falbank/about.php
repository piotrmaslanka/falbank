<?php
	include_once('includes/bootstrap.php');
	
	$taplr = new TAPLReader('templates/about.tpl');
	$temp = $taplr->mkTemplate('index');
	
	$temp->setText('falbankversion','0.1 alfa');
	$temp->setText('techplatformid',APITechplatform::getFullName());
	$temp->setText('tp-prev-branch',APITechplatform::getPrevBranch());
	$temp->setText('tp-branch',APITechplatform::getBranch());
	
	$caps = APITechplatform::getComponents();
	foreach ($caps as $cap => $version)
	{
		$temp->setBlock('tp_components',array('name'=>$cap,'value'=>$version));
	}	
	
	echo($temp->render());
?>
