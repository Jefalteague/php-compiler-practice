<?php

namespace Message;

use Message\Message_Listener_abs as Messsage_Listener_abs;

interface Message_Maker {
	
	public function add_listener($listener);
	public function remove_listener();
	public function send_message();
	
}