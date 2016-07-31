<?php
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['messge'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$messge = $_POST['messge'];

	// Add Header Fields
	// From
	$header = 'From: '. $name . ' <' . $email . '>' . "\r\n";
	// CC's
	$header .= 'Cc: Designer@JoyHarvel.com' . "\r\n";
	$header .= 'Cc: Executive1@JoyHarvel.com' . "\r\n";
	$header .= 'Cc: Executive1@JoyHarvel.com' . "\r\n";
	// BCC's
	$header .= 'Bbc: CEO@JoyHarvel.com' . "\r\n";
	$header .= 'Bbc: Executive1@JoyHarvel.com' . "\r\n";
	$header .= 'Bbc: Executive2@JoyHarvel.com' . "\r\n";

	if(mail('Webmaster@JoyHarvel.com', 'Contact Form Submitted', $messge, $header)) {
		echo 'Message Sent!' . PHP_EOL;
	}else {
		echo 'Message was NOT sent.' . PHP_EOL;
	}
}else {
	echo 'Form not complete.' . PHP_EOL;
}
?>
