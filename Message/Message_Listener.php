<?php

namespace Message;

interface Message_Listener {
	
	public function message_got(Message $message);
	
}