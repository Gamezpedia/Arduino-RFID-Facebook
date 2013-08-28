<?php
require_once 'config.inc.php';
require_once 'lib/class.mysql.php';
require_once 'lib/class.phpmailer-lite.php';

$db = new MySQL($dbhost, $dbuser, $dbpass, $dbname);	
$mail = new PHPMailerLite();

$mail->IsMail(); // telling the class to use native PHP mail()

$message = file_get_contents('contents.html');
$message = str_replace("[RFID]", trim($_POST['rfid']), $message);

try {

  $mail->CharSet = "UTF-8";	
  $mail->SetFrom('registro@powerade.cl', 'registro power');
  $mail->AddAddress($_POST['email_to']);
  $mail->Subject = 'Registra tu pulsera social Powerade';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($message);
  $mail->Send();
  echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}


$sql = "
	INSERT INTO rfid_demo ( 
		rfid,
		email,
		created_at
	) VALUES (
		'". $_POST['rfid'] ."',
		'". $_POST['email_to'] ."',
		NOW()
	)
";

if ($result = $db->query($sql)) {
	echo "OK";	
} else {
	echo "ERROR";
}

?>
