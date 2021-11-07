<?php

namespace Message;

use Message\Message_Listener as Message_Listener;

interface Message_Maker {
	
	public function add_listener(Message_Listener $listener);
	
	public function remove_listener(Message_Listener $listener);
	
	// DESCRIPTION OF MOD: get rid of $token_array
	// modify other components as necessary
	
	// COMMENT OUT TO TEST...
	//public function send_message($message, $token_array);
	
	// UNCOMMENT OUT TO TEST...
	public function send_message($message);
	
}