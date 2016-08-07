#include <SoftwareSerial.h>



void setup() {
  
  Serial.begin(115200);
  pinMode(13, OUTPUT);
}

void loop() {
  digitalWrite(13,HIGH);
  delay(1000);
  digitalWrite(13,LOW);
delay(1000);
digitalWrite(13,HIGH);
delay(1000);
digitalWrite(13,LOW);

Serial.println("hey");
Serial.println(1);
}

