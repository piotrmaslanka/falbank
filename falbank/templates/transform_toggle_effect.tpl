@@prog@@index@@
@@include@@templates/header.tpl@@
  <title>Ustawianie wykonania</title>
</head>
<body>
	@@include@@templates/menu.tpl@@
	@@ifs@@success=1@@success@@error@@
	<p>
	<a href="index.php">Strona główna</a><br />
	<a href="zgloszenie.php?id=%id%">Strona zgłoszenia</a>
	</p>
</body></html>


	@@subblock@@error@@
		<p>Błąd: Sprawdź poprawność danych!</p>
	@@endsubblock@@

	@@subblock@@success@@
		@@ifs@@zrealizowana=1@@zrealizowana@@
		@@ifs@@zrealizowana=0@@niezrealizowana@@ 
	@@endsubblock@@

	@@subblock@@zrealizowana@@
		<p>Ustawiono jako zrealizowaną</p>
	@@endsubblock@@
	@@subblock@@niezrealizowana@@
		<p>Ustawiono jako niezrealizowaną</p>
	@@endsubblock@@
@@endprog@@

