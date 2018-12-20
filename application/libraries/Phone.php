<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH."third_party/Twilio/Twilio/autoload.php");
class Phone {
	private $CI;
	private $sid;
	private $token;

	public function __construct(){
        $this->CI =& get_instance();
        $this->sid = getenv('TWILIO_SID');
        $this->token = getenv('TWILIO_TOKEN');
    }

    public function send_text($message,$recipient){
		$client = new Twilio\Rest\Client($this->sid, $this->token);
		$message = $client->messages->create($recipient, array('from' => '+15407014295','body' => $message));
		return $message->sid;
    }
}
?>
