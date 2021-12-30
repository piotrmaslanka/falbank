@@prog@@index@@
	@@include@@templates/header.tpl@@
	<title>Przyjęcia</title>
	<link rel="stylesheet" type="text/css" href="webres/formcss.css"/>
	<link rel="stylesheet" type="text/css" href="webres/arrpart.css"/></head><body>
	@@include@@templates/menu.tpl@@

	@@ifs@@action=added@@added@@
	@@ifs@@action=modifiedok@@modifiedok@@
	@@ifs@@error=wrongzamowienie@@wrongzamowienie@@
	@@ifs@@error=formincomplete@@formincomplete@@

	<form action="arrpart.php?id=%id%" method="post">
	<div id="centerf">
	<div class="ifield"><label for="nrdd">Numer DD</label><input type="text" name="nrdd" id="nrdd" value="%nrdd%" /></div>
	<div class="ifield"><label for="data">Data</label><input type="text" name="data" id="data" value="%data%" /></div>
	<div class="ifield"><label for="ilosc">Ilość</label><input type="text" name="ilosc" id="ilosc" value="%ilosc%" /></div>
	<div class="ifield"><label for="nrkata">Nr katalogowy</label><input type="text" name="nrkata" id="nrkata" value="%nrkata%" /></div>
	<div class="ifield"><label for="nazwa">Nazwa</label><input type="text" name="nazwa" id="nazwa" value="%nazwa%" /></div>
	<div class="ifield"><label for="fk_nrZam">Numer FALBANK</label><input type="text" name="fk_nrZam" id="fk_nrZam" value="%fk_nrZam%" /></div>
	<div><input id="ok" type="submit" name="ok" value="ok" /></div>
	</div>
	</form>
	
	<div id="magazyn">
		
	</div>

	</body></html>
	
	@@subblock@@formincomplete@@<p>Formularz niekompletny!</p>@@endsubblock@@
	@@subblock@@wrongzamowienie@@<p>Błędny kod zamówienia!</p>@@endsubblock@@
	@@subblock@@added@@	<p>Pomyślnie dodano! Czas %seconds%</p> @@endsubblock@@ 
	@@subblock@@modifiedok@@ <p> Pomyślnie zmodyfikowano! </p> @@endsubblock@@
@@endprog@@



