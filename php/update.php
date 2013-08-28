<?php

require_once 'config.inc.php';
require_once 'lib/class.mysql.php';
require_once 'lib/class.phpmailer-lite.php';

$db = new MySQL($dbhost, $dbuser, $dbpass, $dbname);	

$fbid = $_REQUEST['fbid'];
$rfid = $_REQUEST['rfid'];

$sql = "UPDATE rfid_demo SET fbid = $fbid WHERE rfid = '$rfid'";
if ($result = $db->query($sql)) {
	echo 'OK';
	echo $sql;
} else {
	echo 'ERROR';
}

?>