<?php

namespace Message;

use Message\Message_Listener as Message_Listener;

class Parser_Error_Listener implements Message_Listener{

    /* Properties
    ** 
    **
    */

    public $message;
	public $error_array = [];

    /* Methods
    ** 
    **
    */

    public function message_got($message) {

		
		$this->message = $message;
		
		echo "<br />";
		echo "My_Language Output Errors";
		echo "<hr style='width:50%;text-align:left;margin-left:0'>"; // echo styled line
		
		echo "<br />";
		echo $this->message->get_message_type();
		echo "<br />";

    }

}