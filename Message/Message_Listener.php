<?php

namespace Message;

interface Message_Listener {
	
	// DESCRIPTION OF MOD: get rid of $token_array
	
	// COMMENT OUT TO TEST...
	// public function message_got($message, $token_array);
	
	// UNCOMMENT OUT TO TEST...
	public function message_got($message);
	
}