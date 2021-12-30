@@prog@@index@@
@@include@@templates/header.tpl@@
  <title>Lista zgłoszeń</title>
  <link rel="stylesheet" type="text/css" href="webres/formcss.css" />
  <link rel="stylesheet" type="text/css" href="webres/arrpart.css" />    
</head>
<body>
	@@include@@templates/menu.tpl@@
	<form action="zgloszenia.php" method="get">
	<div id="centerf">
	<input type="hidden" name="mode" value="search" />
	<label for="keyword">Słowo-klucz</label><input type="text" name="keyword" id="keyword"/><br />
	<input type="submit" id="ok" name="ok" value="ok" />
	</div>	
	</form>
</body></html>
@@endprog@@