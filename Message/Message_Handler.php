<?php

namespace Message;

use Message\Message_Listener_abs as Message_Listener_abs;

class Message_Handler {
	
	// properties
	
	public $listeners = [];
	
	// methods 
	
	public function __construct() {
		
		
		
	}
	
	public function add_listener($listener) {
		//var_dump($listener);
		$this->listeners[] = $listener;
		//var_dump($this->listeners);
		
	}
	
	public function remove_listener($listener) {
		
		$this->listeners = $this->listeners;
		
	}
	
	public function send_message() {
		
		$this->notify_listeners();
		
	}
	
	public function notify_listeners() {
		
		foreach($this->listeners as $listener) {
			//var_dump($this->listeners);
			return $listener->message_got();
			
		}
		
	}
	
}