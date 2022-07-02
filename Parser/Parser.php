<?php

namespace Parser;

// use Token\Token2;
// change to use Token\Token\My_Language_Token
use AST\AST as AST;
use Message\Message;
use Token\Token as Token;
use Scanner\Scanner as Scanner;
use Token\Token\My_Language_Token;
use Message\Message_Maker as Message_Maker;
use SymbolTable\Symbol_Table as Symbol_Table;
use Message\Message_Handler as Message_Handler;
use Message\Message_Listener as Message_Listener;
use SymbolTable\Symbol_Table_Stack as Symbol_Table_Stack;
use SymbolTable\Symbol_Table_Factory as Symbol_Table_Factory;

/**
 * Parser
 */

abstract class Parser implements Message_Maker {
	
	/* Properties
	**
	**
	*/
	
	public $ast;
	public $symbol_table_stack;
	public $scanner;
	public $message_handler; // need to figure out how to make single only
	public $config;	// Mak doesn't have a config here
	
	/* Methods 
	**
	**
	*/
	
	public function __construct(Scanner $scanner, $config) {
		
		$this->ast = NULL;
		$this->symbol_table_stack = Symbol_Table_Factory::create_stack();
		$this->scanner = $scanner;
		$this->message_handler = new Message_Handler(); //needs to be single only
		$this->config = $config;

		// have to create some sort of logic to run as a pseudo second constructor to be called by sub-parsers
		// preliminary thinking i feel that it needs to use the calling method as a decision breaking point
		// if the calling class is not Parser then create new Message_Handler, etc
		// if it is Parser then dont create new Message_Handler
		
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

	public function next_token():My_Language_Token/*Token2*/ {
	// change to return My_Language_Token
		return $this->scanner->next_token();

	}

	public function get_current_token():My_Language_Token/*Token2*/ {
	// change to return My_Language_Token
		return $this->scanner->get_current_token();

	}
	
	public function get_scanner():Scanner {

		return $this->scanner;

	}
	
	public function get_ast():AST {

		return $this->ast;

	}
	
	public function get_symbol_table_stack():Symbol_Table_Stack {

		return $this->symbol_table_stack;

	}
	
	abstract public function parse()/*:void*/;



}