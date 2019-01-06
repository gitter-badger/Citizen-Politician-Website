<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/Twilio/Twilio/autoload.php';
use Twilio\TwiML\VoiceResponse;

$response=new VoiceResponse();
$response->say("$message", ['voice'=>'alice','language'=>'en-GB']);
$response->pause(['length'=>2]);
$response->say("$code.", ['voice'=>'alice','language'=>'en-GB']);
$response->pause(['length'=>2]);
$response->say("$message", ['voice'=>'alice','language'=>'en-GB']);
$response->pause(['length'=>2]);
$response->say("$code.", ['voice'=>'alice','language'=>'en-GB']);
$response->pause(['length'=>2]);

echo $response;
?>