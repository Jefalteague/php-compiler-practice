<?php

namespace Message;

use Message\Message_Listener as Message_Listener;

class Message_Handler {
	
	// properties
	private static $instance = NULL;
	public $message;
	public $listeners = [];
	
	// methods

	public static function get_instance() {

		if (self::instance == NULL) {

			$this->instance = new Message_Handler();

		}

		return self::instance;

	}
	
	public function add_listener($listener) {

		$this->listeners[] = $listener;

	}
	
	public function remove_listener($listener) {
		
		// stubbed
		
	}
	
	public function send_message(Message $message, $token_array = NULL) {
		
		$this->message = $message;
		$this->notify_listeners($message, $token_array);
		
	}
	
	public function notify_listeners(Message $message, $token_array) {
		
		foreach($this->listeners as $listener) {

			return $listener->message_got($this->message, $token_array);
			
		}
		
	}
	
}