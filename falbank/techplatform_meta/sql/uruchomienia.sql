
-- Generating table Uruchomienia -- 
CREATE TABLE Uruchomienia (
`id` int unsigned auto_increment ,
`nazwa` varchar (30) ,
`typurzadzenia` varchar (40) ,
`ktouruch` varchar (30) ,
`datauruch` int unsigned ,
`dataostr` int unsigned ,
`uwagi` text ,
`ulica` varchar (40) ,
`kodmiejscowosc` varchar (50) ,
PRIMARY KEY (`id`));
