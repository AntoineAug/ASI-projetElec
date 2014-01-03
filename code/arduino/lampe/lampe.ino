// Numéro des pins utilisés
  int led = A1;
  int ldr = A5;
  int raspberryOut = 23;
  int raspberryIn = 22;
  int lampe = 13;

// Le voltage s'exprime en valeurs analogiques 0-255
  int voltageMax = 255;
  int voltage = 0;

// On initialise les valeurs précédentes pour la première boucle
  int premiereExecution = 1;
  long derniereExecution = 0; 
  int luminositePrecedente = 0;
  
// Temps entre chaque exécution en ms
  float tempsEntreChaqueExecution = 500;
  
// Dernière hausse de la luminosité
  float derniereHausseLuminosite = 0;

// Temps d'allumage de l'ampoule en nombre de tours
  int nombreToursAllumage = 20;

  int alarm = LOW;

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
    
    int seuil = 200;
    
    // Si on n'a pas fait de tests depuis "tempsEntreChaqueExecution"
    if (premiereExecution == 1 || millis() - derniereExecution > tempsEntreChaqueExecution)
    {      
        // On lit les valeurs
        int luminosite = analogRead(ldr);
        int alarm = digitalRead(raspberryIn);
       
        // Si le réveil sonne et que le voltage n'est pas encore max
        if (alarm == HIGH && voltage < voltageMax)
        {          
            // On allume l'ampoule un peu plus
            voltage = voltage + 255 / nombreToursAllumage;
            analogWrite(lampe, voltage);
        }

        // Si l'utilisateur allume la lumière
        if (luminosite < seuil)
        {
            // On envoie le signal d'extinction du réveil
            digitalWrite(raspberryOut, 1);
            analogWrite(lampe, 0);
            voltage = 0;
        }
        else
        {
            digitalWrite(raspberryOut, LOW);
        }

        // On enregistre l'heure de la dernière exécution
        derniereExecution = millis();
        premiereExecution = 0;
    }
}
