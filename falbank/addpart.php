<?php
	include_once('includes/bootstrap.php');
	
	$taplr = new TAPLReader('templates/addpart.tpl');
	$temp = $taplr->mkTemplate('index');
	
	
	if ($_POST['ok']=='ok')
	{
		$chkmsg = new EventInstance('check.parts.add.add',array($_POST));
		if ($chkmsg->wasStopped())
		{
			switch ($chkmsg->getErrMsg())
			{
				case 'addparts.wrongzamowienie':
					$temp->setText('error','wrongzamowienie');
					break;
				case 'form.incomplete':
					$temp->setText('error','formincomplete');
					break;
			}
		} else
		{
			$ei = new EventInstance('parts.add.add',array($_POST));
			$temp->setText('action','added');
		}
	} else
	{
			$temp->setText('action','add');
	}
		
	if ($_POST['fk_nrZam']) $temp->setText('fk_nrZam',$_POST['fk_nrZam']); else	$temp->setText('fk_nrZam',$_GET['zid']);
	if ($_POST['zid']) $temp->setText('zid',$_POST['zid']); else $temp->setText('zid',$_GET['zid']);
	if ($_POST['nrkata']) $temp->setText('nrkata',$_POST['nrkata']); else $temp->setText('nrkata',$_GET['nrkata']);
	
	echo($temp->render());
?>