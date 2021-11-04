<?php

namespace Message;

interface Message_Listener {
	
	public function message_got($message, $token_array);
	
}