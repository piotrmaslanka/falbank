@@prog@@index@@

    @@include@@templates/header.tpl@@
    <title>Uruchomienie</title>
    <link rel="stylesheet" type="text/css" href="webres/formcss.css" />
    <link rel="stylesheet" type="text/css" href="webres/rejestracja.css" />
    <link rel="stylesheet" type="text/css" href="webres/arrpart.css" /></head><body>
    @@include@@templates/menu.tpl@@
    @@include@@templates/rejestracjamenu.tpl@@
    
    @@ifs@@dodano=1@@dodano@@
    @@ifs@@niekompletna=1@@niekompletna@@
    @@ifs@@modified=1@@modified@@
    
    <form action="uruchomienie.php?id=%id%" method="post">
    <div id="centerf">
	<div class="ifield"><label for="nazwa">Nr urządzenia</label><input type="text" name="nazwa" id="nazwa" value="%nazwa%" /></div>
	<div class="ifield"><label for="typurzadzenia">Typ urządzenia</label><input type="text" name="typurzadzenia" id="typurzadzenia" value="%typurzadzenia%" /></div>
	<div class="ifield"><label for="ktouruch">Kto uruchomił</label><input type="text" name="ktouruch" id="ktouruch" value="%ktouruch%" /></div>
	<div class="ifield"><label for="datauruch">Data uruchomienia</label><input type="text" name="datauruch" id="datauruch" value="%datauruch%" /></div>
	<div class="ifield"><label for="dataostr">Data ostatniego przeglądu</label><input type="text" name="dataostr" id="dataostr" value="%dataostr%" /></div>
	<div class="ifield"><label for="uwagi">Uwagi</label><textarea name="uwagi" cols="20" rows="5">%uwagi%</textarea></div>
	<div class="ifield"><label for="ulica">Ulica</label><input type="text" name="ulica" id="ulica" value="%ulica%" /></div>
	<div class="ifield"><label for="kodmiejscowosc">Kod, miejscowość</label><input type="text" name="kodmiejscowosc" id="kodmiejscowosc" value="%kodmiejscowosc%" /></div>
    <input type="submit" name="ok" value="ok" id="ok"/>
    @@ifs@@id=NEW@@null@@panel@@
    </div>	
    </form>
    
    @@subblock@@dodano@@<p>Dodano!</p>@@endsubblock@@
    @@subblock@@niekompletna@@<p>Sprawdź dane!</p>@@endsubblock@@
    @@subblock@@modified@@<p>Zmodyfikowano!</p>@@endsubblock@@
	@@subblock@@null@@ @@endsubblock@@
	@@subblock@@panel@@<p><a href="delete.php?task=Uruchomienie&amp;id=%id%">Usuń</a></p>@@endsubblock@@
	
	</body></html>
@@endprog@@





@@prog@@search@@
@@include@@templates/header.tpl@@
  <title>Szukaj uruchomienia</title>
  <link rel="stylesheet" type="text/css" href="webres/formcss.css" />
  <link rel="stylesheet" type="text/css" href="webres/arrpart.css" />    
  <link rel="stylesheet" type="text/css" href="webres/rejestracja.css" />    
</head>
<body>
	@@include@@templates/menu.tpl@@
    @@include@@templates/rejestracjamenu.tpl@@
	<form action="uruchomienia.php" method="get">
	<div id="centerf" style="margin-top: 2em;">
	<input type="hidden" name="mode" value="search" />
	<label for="keyword">Słowo-klucz</label><input type="text" name="keyword" id="keyword"/><br />
	<input type="submit" id="ok" name="ok" value="ok" />
	</div>	
	</form>
</body></html>
@@endprog@@