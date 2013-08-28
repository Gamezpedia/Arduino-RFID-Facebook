Arduino-RFID-Facebook
=====================

This is a set of files designed to be used as an Arduino + EthernetShield + RFID based facebook feeder.
I used a series of steps in order to ensure propper pairing of users. This repository has only the arduino, php, files.

1. users are registered on an tablet device asking them for their fullname and email, a rfid bracelet was given on return, we scanned the rfid tag for each one and saved its ID on a database along with their personal data, an email 
is sent inviting them to continue with the registry on a facebook app of the brand.

2. when the user visit the facebook app and accept all permissions we added their facebook id to the database and the pairing is complete,
now we have their FBID, RFID TAG NUMBER, EMAIL and FULLNAME, also if user accepted all permisions we had the ability to post actions triggeded on real world on their walls.

3. an arduino with an ethernet shield is loaded with code to send the RFID tag number to a php file in the remote server, and a rfid reader and 

//------------------------------
Electronics components used:

- Arduino Uno: https://www.sparkfun.com/products/11021
- Arduino Ethernet Shield: https://www.sparkfun.com/products/9026
- RFID USB Reader: https://www.sparkfun.com/products/9963
- RFID READER ID-20: https://www.sparkfun.com/products/8628
- RFID TAGS/BRACELETS/CHIPS: https://www.sparkfun.com/products/8310


