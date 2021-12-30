@@prog@@index@@
	@@include@@templates/header.tpl@@
	<title>Lista zgłoszeń</title>
	</head><body>
	@@include@@templates/menu.tpl@@
	
	<table style="width: 100%; margin-top: 10px; text-align: center">
	<tr><th>Numer</th><th>Nazwa klienta</th><th>Typ urządzenia/Adres</th><th>
	@@ifs@@gwara=1@@gwarancyjna_topic@@niegwarancyjna_topic@@</th><th>Data wykonania</th></tr>
	@@block@@zgloszenia@@
		<tr>
			@@ifs@@krecha=1@@krecha@@
			
			@@ifs@@gwara=1@@nrporzadkowy@@nrfalbank@@
			<td>%nazwa%</td>
			@@ifs@@fiolet=1@@niezrealizowana@@zrealizowana@@
			<td>@@ifs@@gwara=1@@gwarancyjna@@niegwarancyjna@@</td>
			<td>%kiedynaprawione%</td>
			
			@@subblock@@nrporzadkowy@@
			<td>%rownum%</td>
			@@endsubblock@@
			
			@@subblock@@nrfalbank@@
			<td><a href="zgloszenie.php?id=%id%">%id%</a></td>
			@@endsubblock@@
			
			@@subblock@@gwarancyjna@@
			%nrproto%</td><td>%rozliczono%
			@@endsubblock@@
			
			@@subblock@@niegwarancyjna@@
			%ktoprzyjal%</td><td>%ktonaprawil%
			@@endsubblock@@			
			
			@@subblock@@zrealizowana@@
				<td><a class="done" href="zgloszenie.php?id=%id%">%typurzadzenia%/%ulica% %kodmiejscowosc%</a></td>
			@@endsubblock@@
			@@subblock@@niezrealizowana@@
				<td><a class="notdone" href="zgloszenie.php?id=%id%">%typurzadzenia%/%ulica% %kodmiejscowosc%</a></td>
			@@endsubblock@@
			@@subblock@@krecha@@
				<td>-----</td>
				<td>-----</td>
				<td>-----</td>
				<td>-----</td>
				<td>-----</td>
				<td>-----</td></tr><tr>
			@@endsubblock@@
		</tr>
	@@endblock@@
	</table>
	</body></html>
	
			@@subblock@@niegwarancyjna_topic@@
				Kto przyjmuje</th><th>Kto wykonuje
			@@endsubblock@@
			
			@@subblock@@gwarancyjna_topic@@
				Nr protokołu</th><th>Faktura?
			@@endsubblock@@
	
@@endprog@@