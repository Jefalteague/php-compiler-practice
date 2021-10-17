<?php

/*
** The abstract Parser class
**
*/

namespace Parser;

use Scanner as Scanner;

abstract class Parser {
	
	/*
		Properties
	*/
	
	protected $int_rep;
	protected $symb_tab;
	protected $scanner;
	
	/*
		Methods
	*/
	
	public function __construct() {}
	
	abstract public function get_scanner();
	
	abstract public function get_int_rep();
	
	abstract public function get_symb_tab();
	
	abstract public function parse();
}