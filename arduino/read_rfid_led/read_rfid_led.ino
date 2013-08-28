#include <SoftwareSerial.h>
#include <Ethernet.h>
#include <SPI.h>
#include <LiquidCrystal.h>


char contents[256];           //This will be a data buffer for writing contents to the file.
char in_char=0;
int index=0;                  //Index will keep track of our position within the contents buffer.

SoftwareSerial mySerial(8, 9); // RX, TX
char tagString[13];
boolean reading = false;

LiquidCrystal lcd(7, 6, 5, 4, 3, 2);

byte serverAppsBond[] = {205,186,173,78}; //ip Address of the server you will connect to
//The location to go to on the server
//make sure to keep HTTP/1.0 at the end, this is telling it what type of file it is
//replace http://myserver.com with your server.

String locationPost = "http://myserver.com/post.php?rfid="; // POST 

// if need to change the MAC address (Very Rare)
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
////////////////////////////////////////////////////////////////////////

EthernetClient client;

char inString[256]; // string for incoming serial data
int stringPos = 0; // string index counter
boolean startRead = false; // is reading?

int OKled = 15;
int WRONGled = 16;

void setup()  
{
 // Open serial communications and wait for port to open:
  Serial.begin(9600);
  lcd.begin(16, 2);
  lcd.print("POWERADE - V1.0");
  lcd.setCursor(0, 1);
  lcd.print("$0");
   while (!Serial) {
    ; // wait for serial port to connect. Needed for Leonardo only
  }
  pinMode(OKled, OUTPUT);
  pinMode(WRONGled, OUTPUT);
  Ethernet.begin(mac);
  // set the data rate for the SoftwareSerial port
  mySerial.begin(9600);
}

void loop() // run over and over
{
 readTAG();
}

void moveText(){
   for (int positionCounter = 0; positionCounter < 13; positionCounter++) {
    // scroll one position left:
    lcd.scrollDisplayLeft();
    // wait a bit:
    delay(150);
  }
}

void readTAG(){
   while(mySerial.available()>0){
   
   int readByte = mySerial.read(); //read next available byte

    if(readByte == 2) reading = true; //begining of tag
    if(readByte == 3) reading = false; //end of tag

    if(reading && readByte != 2 && readByte != 10 && readByte != 13){
      //store the tag
      tagString[index] = readByte;
      if(index == 11){
        Serial.print(tagString);
        lcd.setCursor(0, 1);
       lcd.print("                ");
       lcd.setCursor(0, 1);
       lcd.print("Consultando...");
        showReading();
        
      }
      index ++;
    }else{
      index = 0;
    }
    delay(100);
  }
  
}

void showReading(){
  String pageValue = connectAndRead(); //connect to the server and read the output
  Serial.println(pageValue); //print out the findings.
  itsOK(pageValue);
}

void itsOK(String messageFrom){
  lcd.setCursor(0, 1);
  lcd.print("                ");
  lcd.setCursor(0, 1);
  if(messageFrom == "mismatch"){
    lcd.print("NO REGISTRADO"); 
     digitalWrite(OKled, HIGH);   // turn the LED on (HIGH is the voltage level)
    delay(500);               // wait for a second
    digitalWrite(OKled, LOW);    // turn the LED off by making the voltage LOW
    delay(500); 
  }else{
    lcd.print("GRACIAS " + messageFrom);
    digitalWrite(WRONGled, HIGH);   // turn the LED on (HIGH is the voltage level)
    delay(500);               // wait for a second
    digitalWrite(WRONGled, LOW);    // turn the LED off by making the voltage LOW
    delay(500);  
  }
  delay(1500);               // wait for a second
  lcd.setCursor(0, 1);
  lcd.print("                ");
  lcd.setCursor(0, 1);
  lcd.print("$0");
}

boolean compareTag(char one[], char two[]){
    ///////////////////////////////////
    //compare two value to see if same,
    //strcmp not working 100% so we do this
    ///////////////////////////////////
      if(strlen(one) == 0) return false; //empty
    
      for(int i = 0; i < 12; i++){
        if(one[i] != two[i]) return false;
      }
    
      return true; //no mismatches
}

String connectAndRead(){
  //connect to the server

  Serial.println("connecting...");

  //port 80 is typical of a www page
  if (client.connect(serverAppsBond, 80)) {
    //Serial.println("connected");
    client.print("GET ");
    client.println(locationPost + tagString + " HTTP/1.0");
    client.println();
    //Connected - Read the page
    return readPage(); //go and read the output

  }else{
    return "connection failed";
  }

}

String readPage(){
  //read the page, and capture & return everything between '<' and '>'

  stringPos = 0;
  memset( &inString, 0, 256 ); //clear inString memory

  while(true){

    if (client.available()) {
      char c = client.read();
      Serial.print(c);
      if (c == '<' ) { //'<' is our begining character
        startRead = true; //Ready to start reading the part 
      }else if(startRead){

        if(c != '>'){ //'>' is our ending character
          inString[stringPos] = c;
          stringPos ++;
        }else{
          //got what we need here! We can disconnect now
          startRead = false;
          client.stop();
          client.flush();
          Serial.println("disconnecting.");
          return inString;

        }

      }
    }

  }

}
