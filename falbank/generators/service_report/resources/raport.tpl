@@prog@@index@@
<!-- 
    wzór opracowany prez AMI ITS
    nie licencjonowany do wykorzystania poza programem FALBANK
    jeśli chcesz uzyskać licencję na wykorzystywanie go poza programem FALBANK
    napisz na sppiotr@dms-serwis.com.pl
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl">
<head><title>Raport nr %nr%</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
@@include@@generators/service_report/resources/raport.css@@
</style>
</head><body>
  <div id="t1">
    <div id="r1">
      <span id="rzng">RAPORT Z NAPRAWY GWARANCYJNEJ</span>
      <span id="rzngnr">Nr %nr%</span>
    </div>
    <div id="l1"><img id="logo" src="generators/service_report/resources/dmslogomale.png" alt="Logo firmy" /></div>
  </div>
  
  <div id="t2">
    <div id="n1">
      <span id="nwukn">NAPRAWĘ WYKONANO U KLIENTA</span>
      <span id="ninuifield">%nazwa%</span>
      <span id="ninuidesc">NAZWISKO IMIĘ LUB NAZWA INSTYTUCJI</span>
      <span id="aintkfield">%adrestelefon%</span>
      <span id="aintkdesc">ADRES I NR TELEFONU KONTAKTOWEGO</span>
      <span id="pocztowyfield">%kodpocztowy%</span>
      <span id="pocztowydesc">KOD POCZTOWY</span>
      <span id="miejscowoscfield">%miejscowosc%</span>
      <span id="miejscowoscdesc">MIEJSCOWOŚĆ</span>
    </div>
    <div id="n2">
      <span id="typkotladesc">TYP KOTŁA</span>
      <span id="typkotladescfield">%u1typ%</span>
      <span id="paliwodesc">PALIWO</span>
      <span id="paliwodescfield">%u1paliwo%</span>
      <span id="kociolnrfabrdesc">NR FABR.</span>
      <span id="kociolnrfabrdescfield">%u1nrfabr%</span>
      <span id="kociolrokproddesc">ROK PROD.</span>
      <span id="kociolrokproddescfield">%u1rokprod%</span>
      
      <span id="regulatordesc">URZĄDZENIE 2</span>
      <span id="regulatordescfield">%u2typ%</span>
      <span id="regulatornrfabrdesc">NR FABR.</span>
      <span id="regulatornrfabrdescfield">%u2nrfabr%</span>
      <span id="palnikdesc">ROK PROD.</span>
      <span id="palnikdescfield">%u2rokprod%</span>
      
      <span id="palniknrfabrdesc">URUCHOMIONO</span>
      <span id="palniknrfabrdescfield">%datauruchom%</span>
      <!--<span id="podgrzewaczdesc">PODGRZEWACZ</span>
      <span id="podgrzewaczdescfield">%podgrzewacz%</span>
      <span id="podgrzewacznrfabrdesc">NR FABR.</span>
      <span id="podgrzewacznrfabrdescfield">%podgrznrfabr%</span>
      <span id="datauruchomieniadesc">DATA URUCHOMIENIA</span>
      <span id="datauruchomieniadescfield">%datauruchom%</span>-->
      <span id="ktouruchamialdesc">KTO URUCHAMIAŁ</span>
      <span id="ktouruchamialdescfield">%ktouruchamial%</span>
    </div>
    <div id="af1">
      <span id="opisusterkiczynnosci">OPIS USTERKI - WYKONANE CZYNNOŚCI</span>
      <span id="opisusterkiczynnoscifield">%czynnosci%</span>
    </div>
  </div>
  
  <div id="t3">
  	<div id="wymczbox">Wymienione części</div>
  	<div id="cz1box">
  		<span>1</span>
  		<span class="czpartname">%cz1nazwa%</span>
  		<span class="cznrlabel">nr</span>
  		<span class="czpartnr">%cz1nr%</span>
  		<span class="czowdzo">otrzymałem wcześniej* <span style="text-decoration: line-through">do zwrotu*</span></span>
  	</div>
  	<div id="cz2box">
  		<span>2</span>
  		<span class="czpartname">%cz2nazwa%</span>
  		<span class="cznrlabel">nr</span>
  		<span class="czpartnr">%cz2nr%</span>
  		<span class="czowdzo">otrzymałem wcześniej* <span style="text-decoration: line-through">do zwrotu*</span></span>
  	</div>
  	<div id="cz3box">
  		<span>3</span>
  		<span class="czpartname">%cz3nazwa%</span>
  		<span class="cznrlabel">nr</span>
  		<span class="czpartnr">%cz3nr%</span>
  		<span class="czowdzo">otrzymałem wcześniej* <span style="text-decoration: line-through">do zwrotu*</span></span>
  	</div>
  </div>
  <div id="t4">
  	<div id="n3">
  		<span id="rozliczenieuslugi">ROZLICZENIE USŁUGI:</span>
  		<span id="iloscroboczogodzin">Ilość roboczogodzin</span>
  		<span id="dojazdkm">Dojazd km</span>
  		<span id="iloczroboczogodzinfield">%godzin%</span>
		<span id="dojazdkmfield">%km%</span>
		
		<span id="korobocizny">Koszt robocizny</span>
		<span id="korobociznyfield">%korobocizna%</span>
		<span id="korobociznypln">PLN</span>
		
		<span id="kodojazdu">Koszt dojazdu</span>
		<span id="kodojazdufield">%kodojazd%</span>
		<span id="kodojazdupln">PLN</span>
		
		<span id="koczesci">Koszt części</span>
		<span id="koczescifield">%koczesci%</span>
		<span id="koczescipln">PLN</span>
		
		<span id="razemnettoseparatorline"></span>
		
		<span id="razemnettolabel">Razem netto</span>
		<span id="razemnettofield">%razemnetto%</span>
		<span id="razemnettopln">PLN</span>
  	</div>
  	<div id="n4">
  		<span id="oswdczklienta">OŚWIADCZENIE KLIENTA:</span>
  		<div id="klientpotwierdza">Potwierdzam wykonanie usługi i wymianę wyżej wymienionych części bez zastrzeżeń. Urządzenie pracuje sprawnie</div>
  		<span id="polepodpis">%telefon%</span>
  		<span id="dataipodpisklienta">DATA I PODPIS KLIENTA</span>
  	</div>
  	<div id="n5">
  		<div id="wadczsatak"><span class="middletext">TAK</span></div>
  		<div id="wadczsanie"><span class="middletext">NIE</span></div>
  		<span id="wczsz">Wadliwe części są zwracane ?*</span>
  	</div>
  </div>
  <div id="t5">
  	<span id="t5miejscowosc">Miejscowość</span>
  	<span id="t5miejscowoscfield">%miejscowosc%</span>
  	<span id="t5data">Data</span>
  	<span id="t5datafield">%data%</span>
  	<span id="t5nipserwis">Nazwisko i podpis serwisanta</span>
  	<span id="t5nipserwisfield">%nazwiskoserwisanta%</span>
  </div>
  <div id="t6">
  	<span id="oswddcaption">OŚWIADCZENIE DE DIETRICH:</span>
  	<span id="akceptujemy">Akceptujemy powyższe rozliczenie bez uwag* z poniższymi uwagami*:</span>
  	<div id="prosimyowyst">
  		<span id="prosimycast">Prosimy o wystawienie faktury na kwotę</span>
  		<span id="zlnettofield">%zlnetto%</span>
  		<span id="zlnetto">zł. netto</span>
  	</div>
  	<div id="wroclaw">
  		<span id="wroclawcaption">Wrocław dnia</span>
  		<span id="wroclawfield">%dddata%</span>
  	</div>
  	<span id="niepotrzebneskreslic">*(niepotrzebne skreślić)</span>
  	<span id="sprawdzil">Sprawdził</span>
  	<span id="sprawdzilfield"></span>
  	<span id="nrkosztu">Nr kosztu</span>
  	<span id="nrkosztufield"></span>
  	<span id="poleuwagDD1"></span>
  	<span id="poleuwagDD2"></span>
  </div>
</body></html>
@@endprog@@