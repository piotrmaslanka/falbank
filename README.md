falbank + techplatform
======================

The following is an early version of [SZUS2](https://s2.dms-serwis.com.pl/)
written by me in junior high using PHP.

I also coded a PHP framework for this, it's called techplatform.

If you want a demo version of SZUS2, please visit
[https://demos2.dms-serwis.com.pl](https://demos2.dms-serwis.com.pl)
and follow the on-site instructions.

The only configuration baked into static files
was the access to MySQL. Everything else was stored in the 
database proper.

Techplatform
------------

Techplatform was an early attempt at a framework in PHP.
It contained an ORM where you did define the models
[using XML](falbank/techplatform_meta) which then compiled
output files with a [Python 2 tool](techplatform/suite/ormgen.py).

It also contained a templating library, which is weird, because PHP
is itself an overgrown templating system, basically.