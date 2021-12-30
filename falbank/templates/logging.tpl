@@prog@@login@@
@@include@@templates/header.tpl@@
  <title>Logowanie</title>
  <link rel="stylesheet" type="text/css" href="webres/formcss.css" />
</head>
<body>
	@@ifs@@action=baduser@@baduser@@
	
  		<form action="login.php" method="post">
  		<div style="width: 30%">
  		<div class="ifield"><label for="user">Login</label><input type="text" name="user" id="user" /></div>
  		<div class="ifield"><label for="pass">Hasło</label><input type="password" name="pass" id="pass" /></div>
  		<input type="submit" name="ok" value="ok" style="width: 20%"/>
  		</div>
  		</form>
</body>
</html>

	@@subblock@@baduser@@
		<p>Zła nazwa użytkownika lub hasło!</p>
	@@endsubblock@@
@@endprog@@

@@prog@@logout@@<?xml version="1.0" encoding="utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl">    
<head>
  <title>Wylogowano</title>
</head>
<body>
	<p>Wylogowano. Możesz się <a href="login.php">zalogować ponownie</a></p>
</body>
</html>
@@endprog@@