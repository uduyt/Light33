#define trigPin 2
#define echoPin 4
int duration, distance;
void setup(){
 Serial.begin (9600);
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  pinMode(13, OUTPUT);
}

void loop(){
  
  digitalWrite(trigPin,HIGH);
  delayMicroseconds(100);
  digitalWrite(trigPin,LOW);
  duration = pulseIn(echoPin, HIGH);
  distance= duration/58.2;
  
   if (distance<0) {
     digitalWrite(13,LOW);
   }
   else{
     digitalWrite(13,HIGH);
   }
  Serial.println(distance);
  delay(100);
  
  
}
