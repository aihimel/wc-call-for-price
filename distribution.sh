#! /bin/bash
echo "Creating directory if not exists ...";
if [ ! -d 'dist' ]; then
  mkdir dist
fi;
echo "Copying product files ...";
cp -r assets dist/assets;
cp -r includes dist/includes;
cp -r languages dist/languates;
cp -r templates dist/templates;
cp -r vendor dist/vendor;
cp activation-deactivation.php dist/activation-deactivation.php;
cp composer.json dist/composer.json
cp composer.lock dist/composer.lock
cp functions.php dist/functions.php
cp license.txt dist/license.txt
cp package.json dist/package.json
cp package-lock.json dist/package-lock.json
cp readme.txt dist/readme.txt
cp wc-call-for-price.php dist/cp-call-for-price.php
