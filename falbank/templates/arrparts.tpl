@@prog@@index@@
	@@include@@templates/header.tpl@@
	<title>Części przyjęte</title>
	</head><body>
	@@include@@templates/menu.tpl@@
	
	<table style="width: 100%; text-align: center">
		<tr>
			<th>Nr</th><th>Nazwa</th><th>Nr katalogowy</th><th>Zgłoszenie</th><th>Nr WG De Dietrich</th>
		</tr>
	@@block@@arrparts@@
		<tr>
			<td><a href="arrpart.php?id=%id%">%id%</a></td>
			<td>%nazwa%</td>
			<td>%nrkata%</td>
			<td><a href="zgloszenie.php?id=%fk_nrZam%">Zgłoszenie %fk_nrZam%</a></td>
			<td>%nrdd%</td>
		</tr>
	@@endblock@@
	</table>
	</body></html>
@@endprog@@