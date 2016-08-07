int mot1= 11; /* Entrada motor 1 */
int mot1S1=12;
int mot1S2=8;
int mot2 = 10; /* Entrada motor 2 */
int mot2S1=7;
int mot2S2=5;
int echoPin = 4; /* Salida del sensor HC-SR04*/
int trigPin = 2; /* Activador del sensor HC-SR04 */
int minn = 30; /* Distancia mÃ­nima (cm) a la que quieres que el robot esquive */
int t = 1000;
int duracion;
int distancia;
String readString;
int var;
void setup() {
pinMode(trigPin, OUTPUT); /* Incialicamos las salidas a los motores y a  initPin (activacion del sensor) como salidas, y el de lectura del sensor de entrada */
pinMode(echoPin, INPUT);
pinMode(mot1, OUTPUT);
pinMode(mot2, OUTPUT);
pinMode(mot1S1, OUTPUT);
pinMode(mot2S1, OUTPUT);

pinMode(mot1S2, OUTPUT);
pinMode(mot2S2, OUTPUT);
pinMode(13, OUTPUT);
Serial.begin(9600);
}
void loop() {
digitalWrite(mot1S1, HIGH);
digitalWrite(mot2S2, HIGH);
digitalWrite(mot1S2, LOW);
digitalWrite(mot2S1, LOW);
while(1){
   /*while (Serial.available()>0) {
      delay(3);
      char c = Serial.read();
      readString += c;
    }    
    if (readString.length() > 0) {
      var=readString.toInt();
      Serial.println(var);
    }
    //digitalWrite(mot2,HIGH);
    //digitalWrite(mot1,HIGH);
    
    analogWrite(mot2,var);
    analogWrite(mot1,var);
  readString="";
  */
digitalWrite(trigPin, LOW);   
  delayMicroseconds(2);
digitalWrite(trigPin, HIGH);
delayMicroseconds(10);
digitalWrite(trigPin, LOW); 
duracion= digital
Serial.println(duracion);
//duracion = pulseIn(echoPin, HIGH); /* Definimos la variable pulseTime como el valor en microsegundos de lo que tarda el sensor en recibir el haz de ultrasonidos */
//distancia = (duracion/2) / 29;
Serial.println(duracion);

delay(60);
}
digitalWrite(trigPin, HIGH); /* Inicializamos el pin de activaciÃ³n con valor lÃ³gico alto, y lo mantenemos 2 microsegundos hasta desactivarlo */
delay(0.01);
digitalWrite(trigPin, LOW); /* Con esto hemos mandado un impulso de tensiÃ³n de 10 microsegundos al sensor, lo que activa los ultrasonidos */
duracion = pulseIn(echoPin, HIGH); /* Definimos la variable pulseTime como el valor en microsegundos de lo que tarda el sensor en recibir el haz de ultrasonidos */
distancia = (duracion/2) / 29;
delayMicroseconds(10);
analogWrite(mot1, 255); /* Motor en avance normal */
analogWrite(mot2, 255);
if (distancia <= minn) {
analogWrite(13,255);
analogWrite(mot1, 0); 
analogWrite(mot2,0);
delay(t);
analogWrite(mot1, 255); 
analogWrite(mot2,0);
delay(t);
digitalWrite(13,LOW);
}}


