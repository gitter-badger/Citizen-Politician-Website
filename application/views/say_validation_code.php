<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/Twilio/Twilio/autoload.php';
use Twilio\TwilML\VoiceResponse;

$response=new VoiceResponse();
$response->say("i am kevin");
$response->say("i am kevin");

echo $response;
?>