#! /bin/bash
i=1
for Fichier in `ls`
do
var=$(aircrack-ng -w $Fichier $1)
let i++
if [ $i -le 30 ]
then
echo $Fichier >> recup1
echo "$var `grep -i FOUND`" >> recup1
elif [ $i -ge 31 ] && [ $i -le 60 ]
then
echo $Fichier >> recup2
echo "$var" >> recup2
elif [ $i -ge 61 ]
then
echo $Fichier >> recup3
echo "$var" >> recup3
fi

steven le gay 

#aircrack-ng -w $2 $1
#aircrack-ng -w $3 $1

