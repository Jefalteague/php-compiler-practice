<?php

/*
** The Custom Exception class
**
**
*/

namespace Error;

use Exception;

class Custom_Exception extends Exception {

	public $type;
	
	public $file;
	
	public $value;
	
	public $line_number;
	
	public $column_number;
	
	public function __construct($type, $file, $value, $line_number, $column_number) {
		
		$this->type = $type;
		
		$this->file = $file;
		
		$this->value = $value;
		
		$this->line_number = $line_number;
		
		$this->column_number = $column_number;
		
		$this->errorMessage();
		
	}

	public function errorMessage() {

		$errorMsg = 'This is a FATAL ' . $this->type . ' exception. In SCRIPT: ' . $this->file . ' the ' . $this->value . ' character at LINE NUMBER: ' . $this->line_number . ' and COLUMN NUMBER: ' . $this->column_number . ' is invalid for My_Language.';
		
		return $errorMsg;
	
	}

}