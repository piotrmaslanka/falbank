@@prog@@index@@
	@@include@@templates/header.tpl@@<title>Ustawienia</title>
	<link rel="stylesheet" type="text/css" href="webres/formcss.css" />
	<link rel="stylesheet" type="text/css" href="webres/settings.css" /></head><body>@@include@@templates/menu.tpl@@

	<form action="settings.php" method="post">
	<div id="centerf">
	<div class="ifield"><label for="smtphostname">Serwer SMTP:</label><input type="text" name="smtphostname" id="smtphostname" value="%smtphostname%" /></div>
	<div class="ifield"><label for="smtpusername">Użytkownik SMTP:</label><input type="text" name="smtpusername" id="smtpusername" value="%smtpusername%" /></div>
	<div class="ifield"><label for="smtppassword">Hasło SMTP:</label><input type="password" name="smtppassword" id="smtppassword" value="%smtppassword%" /></div>
	<div class="ifield"><label for="smtprecipients">Odbiorcy<sup>1</sup>:</label><input type="text" name="smtprecipients" id="smtprecipients" value="%smtprecipients%" /></div>
	<div class="ifield"><label for="smtpmyaddress">E-mail nadawcy:</label><input type="text" name="smtpmyaddress" id="smtpmyaddress" value="%smtpmyaddress%" /></div>
	<div class="ifield"><label for="smtpfriendlyname">Przyjazna nazwa konta:</label><input type="text" name="smtpfriendlyname" id="smtpfriendlyname" value="%smtpfriendlyname%" /></div>
	<div class="ifield"><label for="companyname">Nazwa firmy:</label><input type="text" name="companyname" id="companyname" value="%companyname%" /></div>
	<div><input type="submit" id="ok" name="ok" value="ok" /></div>
	<p><sup>1</sup> - wiele adresów przedzielaj znakiem ; np. <em>t1@adres.pl;t2@adres.pl</em></p>
	</div>
	</form>
	
	</body></html>
@@endprog@@