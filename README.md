## Q and I Listening Together

### Introduction

Listening to music with a group of friends representing different preferences should be joyful. ‘Q and I’ is the perfect music system for you and your friends, enriching your shared listening experience. This design facilitates leverage to discussions by showing authorship through color in the queue, represented by rows in both shared interfaces. In this way, everyone can put in their favorite vibes on the digital interface, while present friends can notice when changes are made in the music queue from the tangible interface. 

The aim of this respository is to share how the music-sharing prototype works (specifically the tangible prototype) from a technicial perspective and how to replicate such a prototype (maybe) in other peers' projects.

[![IMAGE ALT TEXT HERE](https://i.imgur.com/znEqw17.jpg)](https://youtu.be/OCxn1qEDHYc)

#### Final prototype 

![M1_DP_DDP005_SISS_2nd_FinalPrototype_Vertical_Plain](https://i.imgur.com/AJ943cI.jpg)

### Techniques

![overview of how the final prototype](https://i.imgur.com/1EhOhZW.gif)

*(An overview of how the final prototype was structured)*

#### Creative and aesthetics

![M1.1_SISS_Report-2](https://i.imgur.com/PBhvHdR.jpg)

To improve the aesthetics of the prototype:

* three different methods of the light diffusings were developed (see figure 1) 
* placing aluminum foyers (area A) underneath the LED strips to diffuse the light evenly (see method 2 and method 3)
* three methods of transparent jointers for connecting each diffuser were applied ( Image 16). These methods allowed lights emitted from the LED strip to travel inside the diffusers and avoid leaving shadows. However, the second method required glues for connecting parts, which would leave the gluing marks on the acrylics and therefore the third method was introduced. (see figure 3, 4, 5, 6)

### Installation guide

#### Specification 

* Laser cutting: [Trotec Speedy 300™](https://educationguide.tue.nl/programs/bachelor-college/majors/industrial-design/facilities/labs/generic-make-labs/dsearch-lab/) (700mm * 400mm dimension)
* [WS28115M60LW30 by BTF-LIGHTING](https://www.amazon.de/BTF-LIGHTING-300LEDs-adressierbare-Streifen-NichtWasserdicht/dp/B01CNL6CM8/ref=sr_1_2?ie=UTF8&qid=1551889870&sr=8-2&keywords=ws2811%2Bstrip%2B5m&th=1) (WS2811 controlled RGB LEDs are much more affordable than the WS2812b ones)
* [ESP8266 NodeMCU V2](https://www.tinytronics.nl/shop/nl/communicatie/rf(id)-wifi-bt/esp8266-nodemcu-v2) or [RobotDyn ESP8266 NodeMCU](https://www.tinytronics.nl/shop/nl/communicatie/rf(id)-wifi-bt/robotdyn-esp8266-nodemcu)
* DC 12v power supply

#### Drivers

![image-20190306174023415](https://i.imgur.com/5nFtvyq.png) 

* Boards Manager: NodeMCU 1.0 (**ESP-12E** Module)
* [USECH340 Driver](http://www.wch.cn/download/CH341SER_MAC_ZIP.html) 
* More information how to use the NodeMCU board as an Arduino board, [Arduino core for ESP8266 WiFi chip](https://github.com/esp8266/Arduino)

#### Dependent libraries

This project only managed to complie with the following libraries and **please do not use any beta library**.

* ArduinoJson `5.13.4`
* Adafruit NeoPixel `1.1.8`
* Adafruit ESP8266 `1.0.0`

#### Scheme

![Untitled Sketch 2_bb](https://i.imgur.com/RVKtjrP.jpg)

*Do not forget to connect all grounds either of the LED strips, NodeMCU, and Power Supply.* 

### Credits

This was a highly colaborative design project finished with a group of four master students at the TU Eindhoven. The development of the tangible prototype was mainly and solely developed by [@Sark P. XING](https://github.com/sarkrui), and the digital tangible (functional) was implemented by [@OliviervDuuren](https://github.com/OliviervDuuren), an interface where users can add songs through and update the database for the NodeMCU to read wirelessly.

