#!/bin/sh


echo "Commiting application ..."

git add *
git commit -m 'Automatic commit'
git push origin master

echo "Application commited!"
