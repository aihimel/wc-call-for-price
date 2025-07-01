#! /bin/bash
cp readme.txt .wordpress-org/trunk/readme.txt
cp readme.txt .wordpress-org/tags/1.5.1/readme.txt
cd .wordpress-org
svn status
svn ci -m 'readme.txt file updated'
cd ..
