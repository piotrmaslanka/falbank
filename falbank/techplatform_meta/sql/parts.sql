
-- Generating table CzesciPrzyjete -- 
CREATE TABLE CzesciPrzyjete (
`id` int unsigned auto_increment ,
`data` int unsigned ,
`nrdd` varchar (20) ,
`fk_nrZam` int unsigned ,
`ilosc` int ,
`nrkata` varchar (20) ,
`nazwa` varchar (20) ,
PRIMARY KEY (`id`));

-- Generating table CzesciZamawiane -- 
CREATE TABLE CzesciZamawiane (
`id` int unsigned auto_increment ,
`ilosc` int ,
`nrkata` varchar (20) ,
`nazwa` varchar (20) ,
`fk_nrZam` int unsigned ,
PRIMARY KEY (`id`));

-- Generating table CzesciDoProtokolu -- 
CREATE TABLE CzesciDoProtokolu (
`id` int unsigned auto_increment ,
`nrkata` varchar (20) ,
`fk_nrZam` int unsigned ,
PRIMARY KEY (`id`));
