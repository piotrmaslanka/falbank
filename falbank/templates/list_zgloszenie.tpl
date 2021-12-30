@@prog@@index@@
@@include@@templates/header.tpl@@
  <title>Lista zgłoszeń</title>
</head>
<body>
	@@include@@templates/menu.tpl@@
	<table>
	@@block@@zgloszenia_list@@
		<tr><td>%nazwa%</td><td>%typurzadzenia%</td></tr>
	@@endblock@@
	</table>
</body></html>
@@endprog@@

