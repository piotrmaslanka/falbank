@@prog@@index@@
	@@include@@templates/header.tpl@@
	<title>Magazyn</title>
	</head><body>
	@@include@@templates/menu.tpl@@
	<table style="width: 100%; text-align: center; margin-top: 2em;">
	<tr><th>Nazwa</th><th>Numer katalogowy</th><th>Stan</th></tr>
	@@block@@magitem@@
		<tr><td>%nazwa%</td><td>%nrkata%</td><td>%ilosc%</td></tr>
	@@endblock@@
	</table>
	</body></html>
@@endprog@@