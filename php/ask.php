<?php
require_once 'lib/class.mysql.php';
require_once 'config.inc.php';

$db = new MySQL($dbhost, $dbuser, $dbpass, $dbname);	


$sql = "SELECT rfid FROM rfid_demo WHERE rfid = ". $_REQUEST['rfid'];
$result = $db->query($sql);
if ($data = $db->fetch_object($result)) {
	echo "true";	
} else {
	echo "false";
}
?>