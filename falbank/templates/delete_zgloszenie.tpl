@@prog@@index@@
@@include@@templates/header.tpl@@
  <title>Kasowanko</title>
</head>
<body>
	@@include@@templates/menu.tpl@@
	@@ifs@@query=1@@pytanie@@skasowano@@
	
	@@subblock@@skasowano@@
		<p>Pomyślnie skasowano! <a href="index.php">Strona główna</a></p>
	@@endsubblock@@
	
	@@subblock@@pytanie@@
		<p>Chcesz wysłać protokół o numerze %id% do piachu!!!<br/>
		Ta operacja jest wybitnie nieodwracalna.<br/>
		Czy chcesz kontynuować?<br/>
		<a href="delete.php?task=Zgloszenie&amp;id=%id%&amp;confirm=1">Kasuj!</a><br/>
		<a href="zgloszenie.php?id=%id%">Nigdy w życiu!</a>
		</p>
	@@endsubblock@@
</body></html>
@@endprog@@

