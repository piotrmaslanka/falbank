@@prog@@index@@
	@@include@@templates/header.tpl@@
	<title>Wysyłanie - błąd!</title>
	</head><body>
	@@include@@templates/menu.tpl@@
	@@ifs@@formincomplete=1@@poprawnosc@@
	@@ifs@@mailfailed=1@@mailfailed@@
	</body></html>
	@@subblock@@poprawnosc@@
		<p>Sprawdź poprawność danych!</br>
		<a href="zgloszenie.php?id=%id%">Strona zgłoszenia</a></p>	
	@@endsubblock@@
	@@subblock@@mailfailed@@
		<p>Nie powiodło się wysyłanie!</br>
		<a href="zgloszenie.php?id=%id%">Strona zgłoszenia</a></p>
	@@endsubblock@@
@@endprog@@