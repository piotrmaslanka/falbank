#! /usr/bin/python

import sys
if len(sys.argv) == 1:
    print 'Usage: ormgen.py [gensql|genphp] source_directory target_directory pkgname subpkgname'
    print 'Source files must end with lowercase xml'
    exit()
 
import os
sdlist = os.listdir(sys.argv[2])
sdlist = filter(lambda x: x[-3:]=='xml', sdlist)
for fname in sdlist:
    if sys.argv[1] == 'gensql':
        print '[ormgen] Generating SQL from '+fname 
        xa = ORMGenerator(fname)
        sql = xa.generateSQL()
        rfn = file(sys.argv[3]+'/'+fname[0:-4]+'.sql', 'w')
        rfn.write(sql)
        del rfn
    if sys.argv[1] == 'genphp':
        pkgname = sys.argv[4]
        subpkgname = sys.argv[5]
        print '[ormgen] Generating PHP from '+fname 
        xa = ORMGenerator(fname)
        sql = xa.generatePHP()
        rfn = file(sys.argv[3]+'/'+fname[0:-4]+'.php', 'w')
        rfn.write(sql)
        del rfn
            