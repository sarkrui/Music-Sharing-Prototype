#include <Adafruit_NeoPixel.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>

//Each PIN_[x] should connect Arduino D[x] pin
#define PIN_1 D1       //define connected strip pin
#define PIN_2 D2       //define connected strip pin
#define PIN_3 D3     //define connected strip pin
#define PIN_4 D4       //define connected strip pin
#define PIN_5 D5       //define connected strip pin

#define LAYERNUM 2  //define the number of strips on each pin
#define LEDNUM 2   //define the number of LEDs on each layer
#define STRIPNUM 10  //define the number of strips

const char* ssid = "SISS";
const char* password = "12341234";

//Define common LED color in HEX format
unsigned long color[10] =
{
  0xFF0000, 0x00FF00, 0x0000FF,
  0xFFFF00, 0xFF0088, 0x00FFFF,
  0x8800FF, 0x00FF55, 0xFF4500,
  0xAAAA99
};

unsigned long currentColor;

//URL of the queue.txt
//const char* URL = "http://music.oliviervanduuren.nl/queue.txt";
const char* URL = "http://music.sarkrui.com/queue.txt";

long queueColor[10];
int stripArray[LAYERNUM][LEDNUM];

//Declarating strip_0 to strip_4
Adafruit_NeoPixel strip_0 = Adafruit_NeoPixel(LAYERNUM * LEDNUM, PIN_1, NEO_BRG + NEO_KHZ800);
Adafruit_NeoPixel strip_1 = Adafruit_NeoPixel(LAYERNUM * LEDNUM, PIN_2, NEO_BRG + NEO_KHZ800);
Adafruit_NeoPixel strip_2 = Adafruit_NeoPixel(LAYERNUM * LEDNUM, PIN_3, NEO_BRG + NEO_KHZ800);
Adafruit_NeoPixel strip_3 = Adafruit_NeoPixel(LAYERNUM * LEDNUM, PIN_4, NEO_BRG + NEO_KHZ800);
Adafruit_NeoPixel strip_4 = Adafruit_NeoPixel(LAYERNUM * LEDNUM, PIN_5, NEO_BRG + NEO_KHZ800);

void setup() {

  //Setup the serial and Wi-Fi
  Serial.begin(115200);
  WiFi.begin(ssid, password);

  //Setup the strips
  setStripArray();
  stripBegin();
  stripInit(5);
  int i = 0;
  while (WiFi.status() != WL_CONNECTED)
  {

    delay(500);
    Serial.println("Connecting...");
    while (i < 10) {

      for (int j = 0; j < 10; j++) {
        setLayerColor(j, color[i]);
        delay(10);
      }
      i++;
    }
  }

}

//Using strtol to convert strings to values
//Source: https://www.thinkage.ca/gcos/expl/c/lib/strtol.html
//Also, https://stackoverflow.com/questions/28104559/arduino-strange-behavior-converting-hex-to-rgb

void loopColor() {

  long setupColor[] = {

    0xFF0000, 0x00FF00, 0x0000FF,
    0xFFFF00, 0xFF0088, 0x00FFFF,
    0x8800FF, 0x00FF55, 0xFF4500,
    0xAAAA99
  };

  for (int x = 0; x < 10; x++) {

    for (int y = 0; x < 10;)
      setLayerColor(y, setupColor[y]);
  }
}

long Str2Hex(const char* hexstring) {

  long hex = (long) strtol(&hexstring[1], NULL, 16);
  return hex;
}

void setStripArray() {
  int ledNumber = 0;
  for (int x = 0; x < LAYERNUM; x++) {
    for (int y = 0; y < LEDNUM; y++) {
      stripArray[x][y] = ledNumber;
      ledNumber++;
    }
  }
}

void stripBegin() {

  strip_0.begin();
  strip_1.begin();
  strip_2.begin();
  strip_3.begin();
  strip_4.begin();
}

//Nothing happens after call setPixel()
//There are two main culprits for this:
//forgetting to call strip.begin() in setup().
//forgetting to call strip.show() after setting pixel colors.
//https://learn.adafruit.com/adafruit-neopixel-uberguide/arduino-library-use#faq-35

void stripInit(char stripNum) {
  switch (stripNum) {
    case 0:
      strip_0.show();
      break;

    case 1:
      strip_1.show();
      break;

    case 2:
      strip_2.show();
      break;

    case 3:
      strip_3.show();
      break;

    case 4:
      strip_4.show();
      break;

    case 5:
      strip_0.show();
      strip_1.show();
      strip_2.show();
      strip_3.show();
      strip_4.show();
      break;
  }
}

//grab data from the URL and update it in the queueColor[10] array
long updateQueue()
{
  if (WiFi.status() == WL_CONNECTED)
  {
    HTTPClient http; //Object of class HTTPClient
    http.begin(URL);
    int httpCode = http.GET();

    if (httpCode > 0)
    {
      const size_t bufferSize = JSON_ARRAY_SIZE(10) + 10 * JSON_OBJECT_SIZE(2);
      DynamicJsonBuffer jsonBuffer(bufferSize);
      JsonObject& root = jsonBuffer.parseObject(http.getString());

      const char* colorRaw_0 = root["position_1"] | "#000";
      const char* colorRaw_1 = root["position_2"] | "#000";
      const char* colorRaw_2 = root["position_3"] | "#000";
      const char* colorRaw_3 = root["position_4"] | "#000";
      const char* colorRaw_4 = root["position_5"] | "#000";
      const char* colorRaw_5 = root["position_6"] | "#000";
      const char* colorRaw_6 = root["position_7"] | "#000";
      const char* colorRaw_7 = root["position_8"] | "#000";
      const char* colorRaw_8 = root["position_9"] | "#000";
      const char* colorRaw_9 = root["position_10"] | "#000";

      long color_0 = Str2Hex(colorRaw_0);
      long color_1 = Str2Hex(colorRaw_1);
      long color_2 = Str2Hex(colorRaw_2);
      long color_3 = Str2Hex(colorRaw_3);
      long color_4 = Str2Hex(colorRaw_4);
      long color_5 = Str2Hex(colorRaw_5);
      long color_6 = Str2Hex(colorRaw_6);
      long color_7 = Str2Hex(colorRaw_7);
      long color_8 = Str2Hex(colorRaw_8);
      long color_9 = Str2Hex(colorRaw_9);


      Serial.println("Queue Color:");

      queueColor[0] = Str2Hex(colorRaw_0);
      queueColor[1] = Str2Hex(colorRaw_1);
      queueColor[2] = Str2Hex(colorRaw_2);
      queueColor[3] = Str2Hex(colorRaw_3);
      queueColor[4] = Str2Hex(colorRaw_4);
      queueColor[5] = Str2Hex(colorRaw_5);
      queueColor[6] = Str2Hex(colorRaw_6);
      queueColor[7] = Str2Hex(colorRaw_7);
      queueColor[8] = Str2Hex(colorRaw_8);
      queueColor[9] = Str2Hex(colorRaw_9);

      currentColor = queueColor[0];


      //Serial.print("Color:");
      //Serial.println(color);

    }
    http.end(); //Close connection
  }
}

//Using [0 - 9] to determine layers
//Using 0xffffff to set colors
//If the strip does not show as expected
//then you might want to check if the grounds are all connected
//inclu. GND of power supply, GND of arduino.

void setLayerColor(char setLayer, long colorHex) {

  //Color Code input in Hex format
  //Using right bit shift to convert colorCodes into R,G,B resepactively
  char R = colorHex >> 16; // right bit shift 16 bits
  char G = colorHex >> 8 & 0xFF; //right bit shift 8 bits
  char B = colorHex & 0xFF;

  //Switch strip layers
  switch (setLayer) {

    //Strip_0
    case 0:
      for (int i = 0; i < LEDNUM; i++) {
        strip_0.setPixelColor(stripArray[0][i], R, G, B);
      }
      stripInit(0);

      break;
    case 1:
      for (int i = 0; i < LEDNUM; i++) {
        strip_0.setPixelColor(stripArray[1][i], R, G, B);
      }
      stripInit(0);
      break;

    //Strip_1
    case 2:

      for (int i = 0; i < LEDNUM; i++) {
        strip_1.setPixelColor(stripArray[0][i], R, G, B);
      }
      stripInit(1);
      break;

    case 3:
      //strip_1.show();
      for (int i = 0; i < LEDNUM; i++) {
        strip_1.setPixelColor(stripArray[1][i], R, G, B);
      }
      stripInit(1);
      break;

    //Strip_2
    case 4:
      for (int i = 0; i < LEDNUM; i++) {
        strip_2.setPixelColor(stripArray[0][i], R, G, B);
      }
      stripInit(2);

      break;
    case 5:

      for (int i = 0; i < LEDNUM; i++) {
        strip_2.setPixelColor(stripArray[1][i], R, G, B);
      }
      stripInit(2);

      break;

    //Strip_3
    case 6:
      //strip_3.show();
      for (int i = 0; i < LEDNUM; i++) {
        strip_3.setPixelColor(stripArray[0][i], R, G, B);
      }
      stripInit(3);

      break;
    case 7:
      //strip_3.show();
      for (int i = 0; i < LEDNUM; i++) {
        strip_3.setPixelColor(stripArray[1][i], R, G, B);
      }
      stripInit(3);

      break;

    //Strip_4
    case 8:

      for (int i = 0; i < LEDNUM; i++) {
        strip_4.setPixelColor(stripArray[0][i], R, G, B);
      }
      stripInit(4);

      break;
    case 9:

      for (int i = 0; i < LEDNUM; i++) {
        strip_4.setPixelColor(stripArray[1][i], R, G, B);
      }
      stripInit(4);
      break;
    default:
      // statements
      break;
  }
}


//Assigning Color to each strip from data received from the designated URL
void assignColor() {

  for (char pointer = 1; pointer < 10; pointer ++) {

    setLayerColor(pointer, queueColor[pointer]);
    Serial.print("*");
    Serial.print(queueColor[pointer], HEX);
    Serial.println();
  }
  Serial.println();
}

void blinkCurrentColor(long colorHex) {

  int times = 40;
  int full = 1;
  float interval = 0.025;
  int delayTimes = 20;
  //For loop times

  char highR = colorHex >> 16; // right bit shift 16 bits
  char highG = colorHex >> 8 & 0xFF; //right bit shift 8 bits
  char highB = colorHex & 0xFF;

  float percent = 0;
  char R;
  char G;
  char B;

  //Lights up
  for (int i = 0; i < times; i++) {

    R = highR * percent;
    G = highG * percent;
    B = highB * percent;

    strip_0.setPixelColor(0, R, G, B);
    strip_0.setPixelColor(1, R, G, B);
    Serial.print(R, HEX);
    Serial.print(G, HEX);
    Serial.print(B, HEX);
    stripInit(0);
    delay(delayTimes);
    percent += interval;
    Serial.println(percent);
  }

  //Lights down
  for (int i = times; i > 0; i--) {

    R = highR * percent;
    G = highG * percent;
    B = highB * percent;

    strip_0.setPixelColor(0, R, G, B);
    strip_0.setPixelColor(1, R, G, B);
    Serial.print(R, HEX);
    Serial.print(G, HEX);
    Serial.print(B, HEX);
    stripInit(0);
    delay(delayTimes);
    percent -= interval;
    Serial.println(percent);
  }

}


void loop() {

  updateQueue();
  blinkCurrentColor(currentColor);
  assignColor();
  delay(50);

}
