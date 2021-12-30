function resum()
{
	godziny = document.getElementById('godziny').value;
	km = document.getElementById('km').value;
	
	
	pole = document.getElementById('kasa');
	pole.innerHTML = (godziny*93)+(km*1.2)+" PLN netto";	
}