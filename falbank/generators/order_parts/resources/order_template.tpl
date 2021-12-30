@@prog@@order@@

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
	<title>FALBANK</title>
</head>
<body>
	<p align=right>%datawyslania%</p>
	<center><h2 style="display:inline">ZGŁOSZENIE NAPRAWY GWARANCYJNEJ</h2><br>(zamówienie części zamiennych)</center><table border=1 width="100%"><tr>
	<td>Serwis zgłaszający: <b>%companyname%</b>
	<br>Nr zgłoszenia FALBANK: <b>%id%</b>
	<br>Typ urządzenia: <b>%typurzadzenia%</b>
	<br>Nr urządzenia: <b>%nrurzadzenia%</b>
	<br>Data uruchomienia: <b>%data%</b><br></td><td>
	<b>Adres klienta: </b>
	<br>%nazwa%
	<br>%ulica%<br>%kodmiejscowosc%
	<br>Telefon nr: %telefon%<b></b></td></tr></table>
<h3>Opis reklamacji klienta</h3>%przyczyna%<h3>Proponowane załatwienie reklamacji</h3>Wymiana części<h3>Proszę o wysłanie następujących części zamiennych:</h3><table border=1>

	@@block@@parts@@
		<tr><td>%nazwa%</td><td>nr kat. %nrkata%</td><td>ilość %ilosc%</td>@@ifs@@meta_workcopy=1@@wcpy_field@@</tr>
		@@subblock@@wcpy_field@@<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>@@endsubblock@@
	@@endblock@@

</table><p align=right>Zamawiający: %ktoprzyjal%</p>
<h2 style="display:inline">ZLECENIE NA NAPRAWĘ GWARANCYJNĄ</h2><br>Powyższą reklamację kwalifikuję,* nie kwalifikuję* do naprawy gwarancyjnej.<br>Zlecam*,nie zlecam* wykonanie naprawy gwarancyjnej.<br>Zgłaszam następujące uwagi: <br><br><br><br>Wrocław dnia: <p align=right><i>Nazwisko i podpis</i><p><br><small>*niepotrzebne skreślić.<br>Dokument generowany elektroniczne przez system FALBANK nie wymaga pieczątki ani podpisu.</small></body></html>


@@endprog@@