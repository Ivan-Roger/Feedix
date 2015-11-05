#! /bin/bash

if [ $# != 1 ]
then
	echo "Usage : $0 \"Message pour le commit\""
else
	git add *
	git rm data/img/*_* --cached
	git commit -m "$1"
	git push origin master
fi
