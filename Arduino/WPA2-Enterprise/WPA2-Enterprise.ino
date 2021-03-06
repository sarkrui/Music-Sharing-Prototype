#include <ESP8266WiFi.h>

extern "C" {
#include "user_interface.h"
#include "wpa2_enterprise.h"
}


// SSID to connect to
static const char* ssid = "";
// Username for authentification
static const char* username = "";
// Password for authentication
static const char* password = "";

bool state = false;
char buff[20];
String ip;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);

  delay(500);

  // WPA2 Connection starts here
  // Setting ESP into STATION mode only (no AP mode or dual mode)
    wifi_set_opmode(STATION_MODE);
    struct station_config wifi_config;
    memset(&wifi_config, 0, sizeof(wifi_config));
    strcpy((char*)wifi_config.ssid, ssid);
    wifi_station_set_config(&wifi_config);
    wifi_station_clear_cert_key();
    wifi_station_clear_enterprise_ca_cert();
    wifi_station_set_wpa2_enterprise_auth(1);
    wifi_station_set_enterprise_identity((uint8*)username, strlen(username));
    wifi_station_set_enterprise_username((uint8*)username, strlen(username));
    wifi_station_set_enterprise_password((uint8*)password, strlen(password));
    wifi_station_connect();
  // WPA2 Connection ends here


  // Wait for connection AND IP address from DHCP
  Serial.println();
  Serial.println("Waiting for connection and IP Address from DHCP");
  while (WiFi.status() != WL_CONNECTED) {
    delay(2000);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  IPAddress myAddr = WiFi.localIP();
  sprintf(buff, "%d.%d.%d.%d", myAddr[0], myAddr[1], myAddr[2], myAddr[3]);
  ip = String(buff);
  Serial.println(ip);
 
}

void loop() {

}
