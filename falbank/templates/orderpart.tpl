@@prog@@index@@
@@include@@templates/header.tpl@@
  <title>Lista zgłoszeń</title>
  <link rel="stylesheet" type="text/css" href="webres/formcss.css" />
  <link rel="stylesheet" type="text/css" href="webres/arrpart.css" />  
</head>
<body>
	@@include@@templates/menu.tpl@@
	@@ifs@@wasadded=1@@wasadded@@
	@@ifs@@action=add@@form_add@@form_mod@@	
	<div style="width: 40%; margin-top: 1em">
	<label for="nrkata">Nr katalogowy*</label><input type="text" name="nrkata" id="nrkata" value="%nrkata%" /><br />
	<label for="nazwa">Nazwa*</label><input type="text" name="nazwa" id="nazwa" value="%nazwa%" /><br />
	<label for="ilosc">Ilość*</label><input type="text" name="ilosc" id="nrkata" value="%ilosc%" /><br />
	<input type="submit" name="ok" value="ok" />
	* - pola wymagane
	</div>	
	</form>
	
	<div id="magazyn">
	<div style="text-align: center; font-size: 1.2em">STAN MAGAZYNU</div>
	<table style="width: 100%"><tr><th>Nazwa</th><th>Nr katalogowy</th><th>Stan</th></tr>
	@@block@@magazyn@@
		<tr>
		<td style="text-align: center; border: 1px solid">%nazwa%</td>
		<td style="text-align: center; border: 1px solid">%nrkata%</td>
		<td style="text-align: center;border: 1px solid">%ilosc%</td>
		</tr>
	@@endblock@@
	</table>
	</div>
	
	@@subblock@@form_mod@@
		<form action="orderpart.php?id=%id%&amp;zid=%zid%" method="post">
	@@endsubblock@@

	@@subblock@@form_add@@	
		<form action="orderpart.php?id=NEW&amp;zid=%zid%" method="post">
	@@endsubblock@@
	
	@@subblock@@wasadded@@
		Dodano!<br />
		<a href="zgloszenie.php?id=%zid%">Do strony zgłoszenia</a>
	@@endsubblock@@
</body></html>
@@endprog@@