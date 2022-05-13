<?php

namespace Parser;

// use Token\Token2;
// change to use Token\Token\My_Language_Token
use Token\Token\My_Language_Token;
use Scanner\Scanner as Scanner;
use SymbolTable\Symbol_Table;
use SymbolTable\Symbol_Table_Stack;
use SymbolTable\Symbol_Table_Factory;
use Message\Message;
use Message\Message_Maker as Message_Maker;
use Message\Message_Handler as Message_Handler;
use Message\Message_Listener as Message_Listener;

/**
 * Parser
 */

abstract class Parser implements Message_Maker {
	
	/* Properties
	**
	**
	*/
	
	protected $ast;
	protected $symbol_table_stack;
	protected $scanner;
	protected $message_handler;
	public $config;
	
	/* Methods 
	**
	**
	*/
	
	public function __construct(Scanner $scanner, Message_Handler $message_handler, $config) {
		
		$this->ast = NULL;
		$this->symbol_table_stack = Symbol_Table_Factory::create_stack();
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

	public function send_message(Message $message):void {
		
		$this->message_handler->send_message($message);
		
	}

	public function make_token():My_Language_Token/*Token2*/ {
	// change to return My_Language_Token
		return $this->scanner->make_token();

	}

	public function get_current_token():My_Language_Token/*Token2*/ {
	// change to return My_Language_Token
		return $this->scanner->get_current_token();

	}
	
	public function get_scanner():Scanner {

		return $this->scanner;

	}
	
	public function get_ast():AST {

		return $this->AST;

	}
	
	public function get_symbol_table_stack():Symbol_Table_Stack {

		return $this->symbol_table_stack;

	}
	
	abstract public function parse()/*:void*/;

}