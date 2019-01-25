<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;
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
		$client = new Client($this->sid, $this->token);
		$message = $client->messages->create($recipient, array('from' => $this->get_number('sms'),'body' => $message));
		return $message->sid;
    }

    public function call($message,$recipient){
    	$client = new Twilio\Rest\Client($this->sid, $this->token);
		$client->account->calls->create($recipient, $this->get_number('voice'), array('url' => site_url("twiML/index/$message")));
		return true;
    }

    private function get_number($capability){
    	$client=new Client($this->sid,$this->token);
		foreach ($client->incomingPhoneNumbers->read() as $value) {
			if($value->capabilities[$capability]){
				return $value->phoneNumber;
			}
		}
		return false;
    }
}
?>
