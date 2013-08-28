<?php
require_once 'config.inc.php';
require_once 'lib/class.mysql.php';
require_once 'lib/class.phpmailer-lite.php';

$db = new MySQL($dbhost, $dbuser, $dbpass, $dbname);	



$sql = "SELECT id FROM chamullo_user WHERE fbuid = ".  $_POST['fbid'];
$result = $db->query($sql);
if ($data = $db->fetch_object($result)) {
	echo 'EXIST';
} else {

	$sql = "
		INSERT INTO chamullo_user (
			fbuid,
			profile_url,
			created_at
		) VALUES (
			'". $_POST['fbid'] ."',
			'". $_POST['profile_url'] ."',
			NOW()
		)";

	$result = $db->query($sql);

	echo 'OK';
}