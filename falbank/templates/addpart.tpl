@@prog@@index@@
	@@include@@templates/header.tpl@@
	<title>Przyjęcia</title>
	<link rel="stylesheet" type="text/css" href="webres/formcss.css"/>
	<link rel="stylesheet" type="text/css" href="webres/arrpart.css"/></head><body>
	@@include@@templates/menu.tpl@@

	@@ifs@@action=added@@added@@
	@@ifs@@error=wrongzamowienie@@wrongzamowienie@@
	@@ifs@@error=formincomplete@@formincomplete@@

	<form action="addpart.php?id=%id%" method="post">
	<div id="centerf">
	<input type="hidden" name="zid" value="%zid%" />
	<div class="ifield"><label for="nrkata">Nr katalogowy</label><input type="text" name="nrkata" id="nrkata" value="%nrkata%" /></div>
	<div class="ifield"><label for="fk_nrZam">Numer FALBANK</label><input type="text" name="fk_nrZam" id="fk_nrZam" value="%fk_nrZam%" /></div>
	<div><input id="ok" type="submit" name="ok" value="ok" /></div>
	</div>
	</form>
	</body></html>
	
	@@subblock@@formincomplete@@<p>Formularz niekompletny!</p>@@endsubblock@@
	@@subblock@@wrongzamowienie@@<p>Błędny kod zamówienia!</p>@@endsubblock@@
	@@subblock@@added@@	<p>Pomyślnie dodano!</p><div><a href="zgloszenie.php?id=%zid%">Wróć</a></div>@@endsubblock@@ 
@@endprog@@



