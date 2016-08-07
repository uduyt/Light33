

String readString;
void setup() {
  
  Serial.begin(9600);
 // esp8266.begin(9600);
  pinMode(13, OUTPUT);
}

void loop() {
  /*
  if (esp8266.available())
  {
    while(esp8266.available())
    {
      char c= esp8266.read();
      Serial.write(c);
      
      
      }
  }*/
    delay(1000);
    
    
      
      Serial.println("AT");
     


}
