@@prog@@index@@
@@include@@templates/header.tpl@@
  <title>Przekształcenia</title>
</head>
<body>
	@@include@@templates/menu.tpl@@
	@@ifs@@error=1@@error@@
	@@ifs@@success=1@@success@@
	
	@@subblock@@error@@
		<p>Wystąpił błąd!<br/>Specyfikacja nie przewiduje żadnych błędów tutaj.</p>
	@@endsubblock@@
	
	@@subblock@@success@@
	<p>Pomyślnie ustawiono! <br /><a href="index.php">Strona główna</a><br />
	<a href="zgloszenie.php?id=%id%">Strona zgłoszenia</a>
	@@endsubblock@@
	</p>
</body></html>
@@endprog@@

