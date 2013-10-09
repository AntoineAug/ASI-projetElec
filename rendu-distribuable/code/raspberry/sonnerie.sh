#!/bin/bash
# À lancer en root pour avoir accès aux GPIO

# Initialisation
echo "7" > /sys/class/gpio/export
echo "in" > /sys/class/gpio/gpio7/direction
gpio=$(cat /sys/class/gpio/gpio7/value)

# Choix de la musique à jouer par ordre aléatoire
ls musique/* |sort -R |tail -$N -n 1 |while read file; do
	alsaplayer -i text $file&
done

# On annonce l'heure à voix haute (synthèse vocale)
heure=$(date +%H)
minute=$(date +%M)
echo "C'est l'heure de se réveiller !, il est $heure heures et $minute minutes"
espeak -v fr -s 200 "C'est l'heure de se réveiller !, il est $heure heures et $minute minutes"

# On continue tant que la lumière n'est pas allumée
while [ $gpio -eq 0 ]
	do
		gpio=$(cat /sys/class/gpio/gpio7/value)
		sleep 1
	done

# Nettoyage
echo "7" > /sys/class/gpio/unexport
killall alsaplayer

# Affichage des informations via l'interface web
./kiosk-browser http://127.0.0.1/P6-raspy