<?php
	/**
	 * Filtruje skrótowce przyjmujących/naprawiających aby rozsądnie pojawiały się na formularzu
	 * @param string $f1 skrótowiec
	 * @return string pełna forma
	 */
	function filter_crew($f1)
	{
		if ($f1 == 'BN') return 'Bogusław Nogaj';
		if ($f1 == 'MM') return 'Marek Maślanka';
		if ($f1 == 'BD') return 'Bogdan Darzecki';
		if ($f1 == 'JC') return 'Joanna Czajka';
		if ($f1 == 'JH') return 'Jadwiga Hakalla';
		return $f1;
	}
?>
