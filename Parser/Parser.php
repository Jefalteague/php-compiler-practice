<?php

/*
** The abstract Parser class
**
*/

namespace Parser;

use Token\Token2;
use Scanner\Scanner as Scanner;
use Message\Message_Maker as Message_Maker;
use Message\Message_Handler as Message_Handler;
use Message\Parser_Listener as Parser_Listener;
use Message\Message_Listener as Message_Listener;
use Scanner\My_Language_Scanner as My_Language_Scanner;

abstract class Parser implements Message_Maker {
	
	/* Properties
	**
	**
	*/
	
	protected $ast;
	protected $symb_tab;
	protected $scanner;
	protected $message_handler;
	public $config;
	
	/* Methods 
	**
	**
	*/
	
	public function __construct(Scanner $scanner, Message_Handler $message_handler, $config) {
		
		$this->ast = NULL;
		$this->symb_tab = NULL;
		$this->scanner = $scanner;
		$this->message_handler = $message_handler;
		$this->config = $config;
		
	}
	
	public function add_listener(Message_Listener $listener):void {
		
		$this->message_handler->add_listener($listener);
		
	}
	
	public function remove_listener(Message_Listener $listener):void {

		$this->message_handler->remove_listener($listener);

	}

	public function send_message($message):void {
		
		$this->message_handler->send_message($message);
		
	}

	public function make_token():Token2 {
	
		return $this->scanner->make_token();

	}
	
	public function get_scanner()/*:Scanner*/ {}
	
	public function get_ast()/*:AST*/ {}
	
	public function get_symb_tab()/*:Symbol_Table*/ {}
	
	abstract public function parse()/*:void*/;

}