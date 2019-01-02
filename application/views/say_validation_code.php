<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/Twilio/Twilio/autoload.php';
use Twilio\TwiML\VoiceResponse;

$response=new VoiceResponse();
$response->say("$message");
$response->pause(['length'=>1.5]);
$response->say("$code.");
$response->pause(['length'=>1.5]);
$response->say("$code.");

echo $response;
?>