int anemometro = 0;

int calculoPromedio(int minutosLectura) 
{
  int promedio = 0;
  for (int i = 0; i < (minutosLectura * 2); i++) //multiplica para aumentar la cantidad de lecturas 
  {
    if (i == 0) {
      promedio = analogRead(0);
      delay(100);//Modificado
    } else {
      promedio = (promedio + analogRead(0)) / (i + 1);// calcula el promedio
      delay(100);//Modificado 
    }
  }
  Serial.println(promedio);
  return promedio;
}

void apagarBomba(int minutosLectura, int minutosApagado) 
{
  int valorDeCorte = 3; // valor de corte por viento
  int promedio = calculoPromedio(minutosLectura);
  if (promedio >= valorDeCorte) {
    digitalWrite(8, LOW);
    digitalWrite(3, HIGH);
    digitalWrite(4, LOW);
    Serial.println("APAGADA");
    delay((minutosApagado - minutosLectura) * 8);//Modificado
    promedio = calculoPromedio(minutosLectura);
    if (promedio < valorDeCorte) {
      digitalWrite(8, HIGH);
      Serial.println("PRENDIDA");
      digitalWrite(3, LOW);
      digitalWrite(4, HIGH);
    }
    else {
      digitalWrite(8, LOW);
      Serial.println("APAGADA");
      digitalWrite(3, HIGH);
      digitalWrite(4, LOW);
    }
  }
  else {
    digitalWrite(8, HIGH);
    Serial.println("PRENDIDA");
    digitalWrite(3, LOW);
    digitalWrite(4, HIGH);
  }
}

void setup() 
{
  Serial.begin(9600);
  pinMode(15, OUTPUT);
  digitalWrite(8, HIGH);
  digitalWrite(3, LOW);
  digitalWrite(4, HIGH);
}



void loop()
{
  apagarBomba(3, 100);
}
