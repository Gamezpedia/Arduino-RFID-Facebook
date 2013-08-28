Arduino-RFID-Facebook
=====================

This is a set of files designed to be used as an Arduino + EthernetShield + RFID based facebook feeder.
I used a series of steps in order to ensure propper pairing of users. 

This repository has only the arduino and posting php files.
I included the emailing script also.
The flash files used on the ipad app and the facebook app are not included.

//------------------------------
Steps

1. users are registered on an tablet device asking them for their fullname and email, a rfid bracelet was given on return, we scanned the rfid tag for each one and saved its ID on a database along with their personal data, an email 
is sent inviting them to continue with the registry on a facebook app of the brand.

2. when the user visit the facebook app and accept all permissions we added their facebook id to the database and the pairing is complete,
now we have their FBID, RFID TAG NUMBER, EMAIL and FULLNAME, also if user accepted all permisions we had the ability to post actions triggeded on real world on their walls.

3. an arduino with an ethernet shield is loaded with code to send the RFID tag number to a php file in the remote server, a rfid reader connected to the shield give us the ID of the tag to be sent.

//------------------------------
Electronics components used:

- Arduino Uno: https://www.sparkfun.com/products/11021
- Arduino Ethernet Shield: https://www.sparkfun.com/products/9026
- RFID USB Reader: https://www.sparkfun.com/products/9963
- RFID READER ID-20: https://www.sparkfun.com/products/8628
- RFID TAGS/BRACELETS/CHIPS: https://www.sparkfun.com/products/8310
- LCD Screen:https://www.sparkfun.com/products/709
- 
//------------------------------
PHP POSTING SCRIPT

<?php
require_once "lib/facebook.php";
require_once "lib/fbmain.php";
//i have only two fbid's to test, mine and my cat-testUser
$fbids = array("637008951", "100002463788678");

$rfid = $_GET['rfid'];
// and i have only two rfid tags to test.
$rfid_one = "39008588AB9F";
$rfid_two = "4D004B20FDDB";

$indexof = -1;
$fbid = "0";

$attachment = array(
	'message' => "TEST",
 	'name' => "TEST",
 	'link' => 'http://www.arduino.cc',
 	'description' => "123 Probando"
 );


if ($rfid == $rfid_one){
	echo "<LUIS>";
	$indexof = 0;
}else if ($rfid == $rfid_two) {
	echo "<NEKO>";
	$indexof = 1;
}else{
	echo "<mismatch>";
}

$fbid = $fbids[$indexof];

if (is_numeric($fbid)) {
	$sendMessage = $facebook->api('/'. $fbid. '/feed/','post',$attachment);
	echo "<ok>";
}

?>




