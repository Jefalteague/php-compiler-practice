<?php

/*
** The abstract Parser class
**
*/

namespace Parser;

use Scanner as Scanner;
use Message\Message_Maker as Message_Maker;
use Message\Message_Handler as Message_Handler;
use Message\Message_Listener as Message_Listener;
use Message\Parser_Listener as Parser_Listener;

abstract class Parser implements Message_Maker {
	
	// properties
	
	protected $int_rep;
	protected $symb_tab;
	protected $scanner;
	public $message_handler;
	
	// methods
	
	public function __construct() {
		
		//$this->message_handler = new Message_Handler();
		//var_dump($this->message_handler);
		
	}
	
	abstract public function add_listener(Message_Listener $listener);
	
	public function remove_listener(Message_Listener $listener) {}
	
	public function send_message($message, $token_array) {}
	
	abstract public function get_scanner();
	
	abstract public function get_int_rep();
	
	abstract public function get_symb_tab();
	
	abstract public function parse();
}