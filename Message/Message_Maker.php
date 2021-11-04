<?php

namespace Message;

use Message\Message_Listener as Message_Listener;

interface Message_Maker {
	
	public function add_listener(Message_Listener_abs $listener);
	public function remove_listener(Message_Listener $listener);
	public function send_message($message, $token_array);
	
}