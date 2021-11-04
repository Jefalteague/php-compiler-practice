<?php

/*
** The Message Class
**
**
*/

namespace Message;



class Message {

	private $message_type;

	public function __construct($message_type) {
		
		$this->message_type = $message_type;
	
	}
	
	public function get_message_type() {
		
		return $this->message_type;
		
	}

}