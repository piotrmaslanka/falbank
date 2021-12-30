<?php
	include_once('includes/bootstrap.php');
	$taplr = new TAPLReader('templates/zgloszenia.tpl');
	$temp = $taplr->mkTemplate('index');
	
	if ($_GET['mode']=='done')
	{
		if ($_GET['param']=='done')
		{
			$res = $db->query('SELECT * FROM Zgloszenie WHERE zrealizowana=1 ORDER BY id DESC',array());
		} elseif ($_GET['param']=='notdone')
		{
			$res = $db->query('SELECT * FROM Zgloszenie WHERE zrealizowana=0 ORDER BY id DESC',array());
		}
	} elseif ($_GET['mode']=='search')
	{
		$keyword = '%'.$_GET['keyword'].'%';
		$res = $db->query("SELECT * FROM Zgloszenie WHERE (nrurzadzenia LIKE %s) || (typurzadzenia LIKE %s) || (nazwa LIKE %s) || (ulica LIKE %s) || (kodmiejscowosc LIKE %s) || (telefon LIKE %s) || (przyczyna LIKE %s) ORDER BY id DESC",array($keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword));
	} elseif ($_GET['mode']=='gwara')
	{
		$temp->setText('gwara','1');
		$res = $db->query("SELECT * FROM Zgloszenie WHERE gwarancyjna=1 ORDER BY kiedynaprawione DESC",array());
	} else
	{
		$res = $db->query("SELECT * FROM Zgloszenie ORDER BY id DESC",array());
	}
		
	$rownum = $db->getRows($res);	
		
	while ($row = $db->toArray($res)) 
	{
		
		$resx = $db->query('SELECT uwagi LIKE "%AWARIA%" as is_awaria FROM Zgloszenie WHERE id=%s',array($row['id']));
		$rowx = $db->toArray($resx);
		$row['is_awaria'] = $rowx['is_awaria'];

		if ($row['kiedynaprawione'])
		{
			$rowmonth = date('m',$row['kiedynaprawione']);
			if (empty($curmonth)) $curmonth = $rowmonth;
			$row['kiedynaprawione'] = date('Y-m-d',$row['kiedynaprawione']);
		}
		else $row['kiedynaprawione'] = '';
		
		if ($_GET['mode']=='gwara')
		{
			if ($curmonth != $rowmonth)
			{
				$curmonth = $rowmonth;
				$row['krecha'] = 1;
			}
			$res2 = $db->query('SELECT nrproto, rozliczono FROM ZgloszenieGwarancyjne WHERE id=%s',array($row['fk_zgl_gwara']));
			$rln = $db->toArray($res2);
			$row['rozliczono'] = ($rln['rozliczono'] == 1 ? 'TAK' : 'NIE');
			$row['nrproto'] = $rln['nrproto'];
			$row['rownum'] = $rownum;
			if ($rln['rozliczono']==0) $row['fiolet'] = 1;
		}

		if ($row['zrealizowana']==0) $row['fiolet'] = 1;

		if ($row['is_awaria']!=0) $row['typurzadzenia'] = '<b style="color: red;">(AWARIA)</b>'.$row['typurzadzenia'];

		$temp->setBlock('zgloszenia',$row);
		$rownum--;
	}
	
	
	echo($temp->render());
?>
