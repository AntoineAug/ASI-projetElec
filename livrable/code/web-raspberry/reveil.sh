#!/bin/bash

#réveil intelligent
date_demarage=$(date +%D)
heure_demarage=$(date +%H:%M:%S)

printf "Démarage du réveil \nNous sommes le $date_demarage, il est $heure_demarage.\n"
printf "Veuillez entrer l'heure à laquelle vous voulez vous réveillez\n(au format HH) : "
read -p "" heure_reveil
printf "Veuillez entrer la minute à laquelle vous voulez vous réveillez\n(au format MM) : "
read -p "" minute_reveil

#crontab -l >fichiercron.backup #pour récupérer le fichier cron actuel
echo "$minute_reveil $heure_reveil * * * ~/p6-raspy/sonnerie.sh ">fichiercron
crontab fichiercron
#rm fichiercron