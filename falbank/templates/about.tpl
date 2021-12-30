@@prog@@index@@
	@@include@@templates/header.tpl@@
	<title>O programie</title></head><body>
	@@include@@templates/menu.tpl@@

	
	<div>
		<strong>Autor systemu Falbank: </strong> Piotr Maślanka <br />
		<strong>Wersja systemu Falbank: </strong> %falbankversion%	<br />
		<strong>Wersja systemu Techplatform: </strong> %techplatformid%	<br />
		<strong>Gałęzie rozwojowe Techplatform: </strong> %tp-prev-branch% -&gt; %tp-branch% <br />
		<strong>Lista komponentów Techplatform: </strong><br />
		<div>
		@@block@@tp_components@@
			<em>%name%:</em> %value% <br />
		@@endblock@@
		</div>
	</div>
	</body></html>
@@endprog@@