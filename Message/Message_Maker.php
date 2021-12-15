<?php

namespace Message;

use Message\Message_Listener as Message_Listener;

/**
 * Message_Maker
 */

interface Message_Maker {
	
	/* Properties
	**
	**
	*/
	
	/* Methods 
	**
	**
	*/
	
	public function add_listener(Message_Listener $listener);

	public function remove_listener(Message_Listener $listener);

	public function send_message(Message $message);

}