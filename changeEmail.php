<?php
require 'Resources/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;

$mail->isSMTP();
$mail->Host = $_POST['smtp'];
$mail->SMTPAuth = true;
$mail->Username = htmlspecialchars($_POST['email']);
$mail->Password = htmlspecialchars($_POST['pass']);
$mail->SMTPSecure = ($_POST['smtp']=="smtp.mail.yahoo.com") ? 'ssl':'tls';
$mail->Port = ($_POST['smtp']=="smtp.mail.yahoo.com") ? 465:587;

$mail->setFrom(htmlspecialchars($_POST['email']), 'Mwananchi');
$mail->addAddress(htmlspecialchars($_POST['test']));
$mail->addReplyTo(htmlspecialchars($_POST['email']), 'Website Admin');
$mail->isHTML(true);

$mail->Subject = "Testing New Email.";
$mail->Body    = "If you are seeing this mail then new Mwananchi Website email has been set. Thankyou, have a good day.";

if(!$mail->send()) {
    echo 'Message could not be sent.'.$mail->ErrorInfo;
} else {
	$key=openssl_random_pseudo_bytes(16);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-ctr"));
    $cipherText = openssl_encrypt(htmlspecialchars($_POST['pass']), "aes-256-ctr", $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv);
    $hmac = hash_hmac('sha256', $cipherText, $key, $as_binary=true);
	$encryptedPassword = base64_encode( $iv.$hmac.$cipherText);
	$file=fopen("Resources/Site Data/SiteEmail.txt", "w+");
	fwrite($file,htmlspecialchars($_POST['email']).PHP_EOL.$_POST['smtp'].PHP_EOL.$encryptedPassword.PHP_EOL.$key);
	fclose($file);
    echo 'Email has been changed successfully. Check your test email to see if email has been received correctly.';
}
?>