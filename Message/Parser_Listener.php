<?php

namespace Message;

class Parser_Listener {
	
	// properties
	
	public $message;
	
	// methods
	
	public function __construct($message) {
		
		$this->message = $message;
		
	}

	public function message_got() {
		
		echo $this->message;
		
	}
	
}