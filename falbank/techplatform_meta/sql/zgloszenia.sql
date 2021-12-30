
-- Generating table Zgloszenie -- 
CREATE TABLE Zgloszenie (
`id` int unsigned auto_increment ,
`nrurzadzenia` varchar (30) ,
`typurzadzenia` varchar (20) ,
`ulica` varchar (150) ,
`kodmiejscowosc` varchar (50) ,
`telefon` varchar (15) ,
`przyczyna` text ,
`ktonaprawil` varchar (30) ,
`uwagi` text ,
`kiedynaprawione` int unsigned ,
`kiedyzgloszone` int unsigned ,
`ktoprzyjal` varchar (30) ,
`zrealizowana` tinyint ,
`gwarancyjna` tinyint ,
`fk_zgl_gwara` int unsigned ,
`nazwa` varchar (40) ,
PRIMARY KEY (`id`));

-- Generating table ZgloszenieGwarancyjne -- 
CREATE TABLE ZgloszenieGwarancyjne (
`id` int unsigned auto_increment ,
`km` float ,
`godziny` float ,
`nrproto` varchar (50) ,
`opis` text ,
`u1typ` varchar (30) ,
`u1paliwo` varchar (30) ,
`u1nrfabr` varchar (30) ,
`u1rokprod` varchar (30) ,
`u2typ` varchar (30) ,
`u2nrfabr` varchar (30) ,
`u2rokprod` varchar (30) ,
`datauruchom` int unsigned ,
`ktouruchom` varchar (20) ,
`zamkniete` tinyint ,
`wyslano_liste_czesci` int unsigned ,
PRIMARY KEY (`id`));
