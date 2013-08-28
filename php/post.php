<?php
require_once "lib/facebook.php";
require_once "lib/fbmain.php";

$fbid = "637008951";
$rfid = $_GET['rfid'];
$rfid_one = "39008588AB9F";
$rfid_two = "4D004B20FDDB";

/*$attachment = array(
	'message' => "TEST",
 	'name' => "TEST",
 	'link' => 'http://www.theguaz.com',
 	'description' => "123 Probando"
 );

if (is_numeric($fbid)) {
	$sendMessage = $facebook->api('/'. $fbid. '/feed/','post',$attachment);
	echo "<ok>";
}
*/
if ($rfid == $rfid_one){
	echo "<LUIS>";
}else if ($rfid == $rfid_two) {
	echo "<NEKO>";
}else{
	echo "<mismatch>";
}
?>