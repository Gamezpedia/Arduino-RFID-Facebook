<?php
require_once "lib/facebook.php";
require_once "lib/fbmain.php";

$fbids = array("637008951", "100002463788678");

$rfid = $_GET['rfid'];
$rfid_one = "39008588AB9F";
$rfid_two = "4D004B20FDDB";

$indexof = -1;
$fbid = "0";

$attachment = array(
	'message' => "TEST",
 	'name' => "TEST",
 	'link' => 'http://www.arduino.cc',
 	'caption' => 'Consigue tu pulsera aqui.', 
 	'picture' => 'http://www.appsbond.cl/powerade/tabs/test-rfid/compartelo.jpg';
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