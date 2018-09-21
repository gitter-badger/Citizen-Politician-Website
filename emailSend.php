<?php
require "Connection.php";
if(isset($_POST['users'])){
	$users=json_decode(stripslashes($_POST['users']));
	$emails=array();

	foreach ($users as $user) {
		$stmt=$connection->query("select Email from citizen_profile where Username='$user' union all select email from politician_profile where userName='$user'");
		if($stmt){
			if($row=$stmt->fetch_array(MYSQLI_NUM)){
				array_push($emails,$row[0]);
			}else{
				echo $connection->error;
				return;
			}
		}else{
			echo $connection->error;
			return;
		}
	}
}else{
	$user=$connection->real_escape_string($_POST['user']);
	$type=$connection->real_escape_string($_POST['type']);
	$stmt=$connection->query("select Email from citizen_profile where Username='$user' or Email='$user' union all select email from politician_profile where userName='$user' or email='$user'");
	if($stmt){
		if(mysqli_num_rows($stmt)<1){
			echo "Username or email not found in database.";
			return;
		}
		if($row=$stmt->fetch_array(MYSQLI_NUM)){
			$email=$row[0];
			if($type==="password"||$type==="email"||$type==="phone"){
				$stmt=$connection->query("delete from emailGetCredentials where userEmail='$user' and type='$type'");
				$stmt=$connection->query("select eventID from emailGetCredentials");
				if($stmt){
					$newID=mysqli_num_rows($stmt)+1;
					$stmt=$connection->prepare("insert into emailGetCredentials(eventID,userEmail,passCode,type) values (?,?,?,?)");
					$passCode=$_POST['passCode'];
					if($stmt->bind_param("isss",$newID,$user,$passCode,$type)){
						if($stmt->execute()){
							$_POST['message'].="<br> <a href='https://mwananchi.herokuapp.com/ResetPassword.php?id=".password_hash($user,PASSWORD_DEFAULT)."&encodedPassCode=$passCode'>Click Me</a><br>";
						}
					}
				}else{
					echo $connection->error;
					return;
				}
			}
		}else{
			echo $connection->error;
			return;
		}
	}else{
		echo $connection->error;
		return;
	}
}

$file=fopen("Resources/Site Data/SiteEmail.txt", "r");
$from = fgets($file);
$encryptedPassword=fgets($file);
$key=fgets($file);
fclose($file);

$longText = base64_decode($encryptedPassword);
$iv = substr($longText, 0, openssl_cipher_iv_length("aes-256-ctr"));
$hmac = substr($longText, openssl_cipher_iv_length("aes-256-ctr"), $sha2len=32);
$ciphertext = substr($longText, openssl_cipher_iv_length("aes-256-ctr")+$sha2len);
$password = openssl_decrypt($ciphertext, "aes-256-ctr", $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv);

$subject = $_POST['subject'];
$message=$_POST['message'];

$body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns:v='urn:schemas-microsoft-com:vml'><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /><meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' /><meta name='viewport' content='width=600,initial-scale = 2.3,user-scalable=no'><!--[if !mso]> --><link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'><link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'><!--<![endif]--><title>Mwananchi</title><style type='text/css'>body {width: 100%;background-color: #ffffff;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;mso-margin-top-alt: 0px;mso-margin-bottom-alt: 0px;mso-padding-alt: 0px 0px 0px 0px;}p,h1,h2,h3,h4 {margin-top: 0;margin-bottom: 0;padding-top: 0;padding-bottom: 0;}span.preheader {display: none;font-size: 1px;}html {width: 100%;}table {font-size: 14px;border: 0;}@media only screen and (max-width: 640px) {.main-section-header {font-size: 28px !important;}.show {display: block !important;}.hide {display: none !important;}.align-center {text-align: center !important;}.no-bg {background: none !important;}.main-image img {width: 440px !important;height: auto !important;}.divider img {width: 440px !important;}.container590 {width: 440px !important;}.container580 {width: 400px !important;}.main-button {width: 220px !important;}.section-img img {width: 320px !important;height: auto !important;}.team-img img {width: 100% !important;height: auto !important;}}@media only screen and (max-width: 479px) {.main-section-header {font-size: 26px !important;}.divider img{width: 280px !important;}.container590 {width: 280px !important;}.container590 {width: 280px !important;}.container580 {width: 260px !important;}.section-img img {width: 280px !important;height: auto !important;}}</style><!--[if gte mso 9]>--><style type=”text/css”>body {font-family: arial, sans-serif!important;}</style><!--<![endif]--></head><body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'><table style='display:none!important;'><tr><td><div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>Mwananchi Website</div></td></tr></table><table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'><tr><td align='center'><table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'><tr><td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td></tr><tr><td align='center'><table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'><tr><td align='center' height='70' style='height:70px;'><a href='https://mwananchi.herokuapp.com' style='display: block; border-style: none !important; border: 0 !important;font-size: 28px;font-family: cursive;color: lightblue;'><img width='100' border='0' style='display: block; width: 100px;' src='https://mwananchi.herokuapp.com/MwananchiIcon.png' alt='' /></a></td></tr></table></td></tr><tr><td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td></tr></table></td></tr></table><table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'><tr><td align='center'><table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'><tr><td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;' class='main-header'><div style='line-height: 35px'>Welcome to <span style='color: #5caad2;'>Mwananchi Website</span></div></td></tr><tr><td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td></tr><tr><td align='center'><table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'><tr><td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td></tr></table></td></tr><tr><td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td></tr><tr><td align='left'> <table border='0' width='590' align='left' cellpadding='0' cellspacing='0' class='container590'><tr><td align='left' style='color: #888888; font-family: Work Sans, Calibri, sans-serif; line-height: 24px;'><p style='font-size: 16px;line-height: 24px; margin-bottom:15px;'>Dear User,</p><p style='line-height: 24px;margin-bottom:15px;font-size=12px;'><i>".$message."</i></p><p style='font-size: 14px;line-height: 24px'>Yours Sincerely,<br>The Mwananchi Website Team.</p></td></tr></table></td></tr></table></td></tr><tr><td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td></tr></table><table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='2a2e36'><tr><td align='center' style='background-image: url(https://mwananchi.herokuapp.com/background.JPG); background-size: cover; background-position: top center; background-repeat: no-repeat;' background='https://mwananchi.herokuapp.com/background.JPG'><div style='background-color: rgba(0,0,0,0.8);'><table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'><tr><td height='50' style='font-size: 50px; line-height: 50px;'>&nbsp;</td></tr><tr><td align='center'><table border='0' width='380' align='center' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'class='container590'><tr><td align='center'><table border='0' align='center' cellpadding='0' cellspacing='0' class='container580'><tr><td align='center' style='color: white; font-size: 16px; font-family: Work Sans, Calibri, sans-serif; line-height: 26px;'><div style='line-height: 26px'>Want to help us grow? Visit our help page and give us sugggestions on how to make you more happy.</div></td></tr></table></td></tr></table></td></tr><tr><td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td></tr><tr><td align='center'><table border='0' align='center' width='250' cellpadding='0' cellspacing='0' style='border:2px solid #ffffff;'><tr><td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td></tr><tr><td align='center' style='color: #ffffff; font-size: 14px; font-family: Work Sans, Calibri, sans-serif; line-height: 22px; letter-spacing: 2px;'><div style='line-height: 22px;'><a target='_blank' href='Https://mwananchi.herokuapp.com/HelpPage.php' style='color: #fff; text-decoration: none;'>VISIT THE HELP PAGE</a></div></td></tr><tr><td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td></tr></table></td></tr><tr><td height='50' style='font-size: 50px; line-height: 50px;'>&nbsp;</td></tr></table></div></td></tr></table><table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'><tr><td height='60' style='font-size: 60px; line-height: 60px;'>&nbsp;</td></tr><tr><td align='center'><table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590 bg_color'><tr><td align='center'><table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590 bg_color'><tr><td><table border='0' width='300' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;' class='container590'><tr><td align='left'><a href='mwananchi.herokuapp.com' style='display: block; border-style: none !important; border: 0 !important;'><img width='50' border='0' style='display: block; width: 50px;' src='https://mwananchi.herokuapp.com/MwananchiIcon.png' alt='' /></a></td></tr><tr><td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td></tr><tr><td align='left' style='color: #888888; font-size: 14px; font-family: Work Sans, Calibri, sans-serif; line-height: 23px;' class='text_color'><div style='color: #333333; font-size: 14px; font-family: Work Sans, Calibri, sans-serif; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;'>Email us: <br/> <a href='mailto:$from' style='color: #888888; font-size: 14px; font-family: Hind Siliguri, Calibri, Sans-serif; font-weight: 400;'>$from</a></div></td></tr></table><table border='0' width='2' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;' class='container590'><tr><td width='2' height='10' style='font-size: 10px; line-height: 10px;'></td></tr></table><table border='0' width='200' align='right' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;' class='container590'><tr><td class='hide' height='45' style='font-size: 45px; line-height: 45px;'>&nbsp;</td></tr><tr><td height='15' style='font-size: 15px; line-height: 15px;'>&nbsp;</td></tr><tr><td><table border='0' align='right' cellpadding='0' cellspacing='0'><tr><td><a target='_blank' href='https://github.com/dopesky/citizen-politician-website' style='display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='https://mwananchi.herokuapp.com/github.png' alt=''></a></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><a target='_blank' href='https://twitter.com/dopesky001' style='display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='http://i.imgur.com/Qc3zTxn.png' alt=''></a></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><a target='_blank' href='https://www.facebook.com/voxy.v.mcmwenda' style='display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='http://i.imgur.com/RBRORq1.png' alt=''></a></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><a target='_blank' href='https://linkedin.com/in/kevin-kathendu-759062147' style='display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='https://cdn3.iconfinder.com/data/icons/free-social-icons/67/linkedin_circle_gray-24.png' alt=''></a></td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr><tr><td height='60' style='font-size: 60px; line-height: 60px;'>&nbsp;</td></tr></table><table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='f4f4f4'><tr><td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td></tr><tr><td align='center'><table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'><tr><td><table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;' class='container590'><tr><td align='left' style='color: #aaaaaa; font-size: 14px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px;'><div style='line-height: 24px;'><span style='color: #333333;'>Mwananchi, Leadership with Service.</span></div></td></tr></table><table border='0' align='left' width='5' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;' class='container590'><tr><td height='20' width='5' style='font-size: 20px; line-height: 20px;'>&nbsp;</td></tr></table><table border='0' align='right' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;' class='container590'><tr><td align='left'><table align='left' border='0' cellpadding='0' cellspacing='0'><tr><td align='left'><span style='font-size: 14px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px;color: #5caad2; text-decoration: none;font-weight:bold;'>All replies should be addressed to this email.</span></td></tr></table></td></tr></table></td></tr></table></td></tr><tr><td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td></tr></table></body></html>";

require 'Resources/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = $from;
$mail->Password = $password;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom($from, 'Mwananchi Website');
if(isset($_POST['users'])){
	foreach ($emails as $email) {
		$mail->addAddress($email);
	}
}else{
	$mail->addAddress($email);
}
$mail->addReplyTo($from, 'Website Admin');
$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body    = $body;

if(!$mail->send()) {
    echo 'Message could not be sent.'.$mail->ErrorInfo;
} else {
    echo 'Email message has been sent successfully';
}
?>