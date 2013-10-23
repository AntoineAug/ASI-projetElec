// Numéro des pins utilisés
  int led = 13;
  int ldr = A5;
  int raspberryOut = 22;
  int raspberryIn = 23;
  int lampe = 20;

// Le voltage s'exprime en valeurs analogiques 0-255
  int voltageMax = 255;
  int voltage = 0;

// On initialise les valeurs précédentes pour la première boucle
  int premiereExecution = 1;
  long derniereExecution = 0; 
  int luminositePrecedente = 0;

// Temps entre chaque exécution
  float tempsEntreChaqueExecution = 0.3;
  
// Dernière hausse de la luminosité
  float derniereHausseLuminosite = 0;

// Temps d'allumage de l'ampoule en nombre de tours
  int nombreToursAllumage = 10;

void setup()
{
	pinMode(led, OUTPUT); 
	pinMode(raspberryOut, OUTPUT);
	pinMode(ldr, INPUT);
        pinMode(raspberryIn, INPUT);
        pinMode(lampe, OUTPUT);
}

void loop()
{
    int seuil = 20;
    // Si la luminosité dépasse cette valeur, le réveil ne peut plus s'arreter car la hausse ne peut plus etre supérieure au seuil 
    int luminositeMax = 255 - seuil;

    // Si on a pas fait de tests depuis "tempsEntreChaqueExecution"
    if (premiereExecution == 1 || millis() - derniereExecution > tempsEntreChaqueExecution)
    {
        // On lit les valeurs
        int luminosite = analogRead(ldr);
        int raspberryIn = digitalRead(raspberryIn);          
      
        // Si le réveil sonne et que le voltage n'est pas encore max
        if (raspberryIn && voltage < voltageMax)
        {
            // On allume l'ampoule un peu plus
            voltage = voltage + 255 / nombreToursAllumage;
            analogWrite(lampe, voltage);
        }

        // Si l'utilisateur allume la lumière (forte hausse de la luminosité) ou si la pièce est déjà très éclairée (luminosite > luminositeMax)
        if (luminosite - luminositePrecedente > seuil || luminosite > luminositeMax)
        {
            // On envoie le signal d'extinction du réveil
            digitalWrite(raspberryOut, HIGH);
            
            // On enregistre l'heure de la dernière hausse de luminosité
            derniereHausseLuminosite = millis();
        }
        
        // Si la hausse de luminosité est survenue il y a plus de 3s on arrete d'envoyer le signal d'extinction
        if (premiereExecution == 1 || millis() - derniereHausseLuminosite > 3000)
        {
            // État par défaut du réveil (la pièce est noire)
            digitalWrite(raspberryOut, LOW);
        }

        // On se souvient de la dernière luminosité
        luminositePrecedente = luminosite;

        // On enregistre l'heure de la dernière exécution
        derniereExecution = millis();
        premiereExecution = 0;
    }
}
