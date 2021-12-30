@@prog@@index@@

    @@include@@templates/header.tpl@@
    <title>Uruchomienie</title>
    <link rel="stylesheet" type="text/css" href="webres/formcss.css" />
    <link rel="stylesheet" type="text/css" href="webres/rejestracja.css" />
    <link rel="stylesheet" type="text/css" href="webres/arrpart.css" /></head><body>
    @@include@@templates/menu.tpl@@
    @@include@@templates/rejestracjamenu.tpl@@

	<table style="width: 100%; text-align: center; margin-top: 1em;"><tr>
	<th>Nr porządkowy</th><th>Typ urządzenia</th><th>Nr urządzenia</th><th>Adres</th></tr>
	@@block@@uruchomienia@@
		<tr><td>%id%</td>
		<td>%typurzadzenia%</td>
		<td><a href="uruchomienie.php?id=%id%">%nazwa%</a></td>
		<td>%ulica% %kodmiejscowosc%</td></tr>
	@@endblock@@
	</table>

	</body></html>
@@endprog@@