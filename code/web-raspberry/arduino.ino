// Numéro des pins utilisés
int led = 13;
int ldr = A5;
int raspberry = 22;

void setup()
{
	pinMode(led, OUTPUT); 
	pinMode(raspberry, OUTPUT);
	pinMode(ldr, INPUT); 
}
 
void loop()
{
	// On attend une seconde avant de continuer
	delay(1000);

	int luminosite = analogRead(ldr);
	if(luminosite <200)
	{
		digitalWrite(raspberry,HIGH);
		digitalWrite(led, HIGH);
	}
	else
	{
		digitalWrite(raspberry,LOW);
		digitalWrite(led, LOW);
	}
}