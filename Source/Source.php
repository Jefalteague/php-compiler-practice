<?php

/*
** The abstract Source class
**
*/

namespace Source;

abstract class Source {
	
	/* abstract methods*/
	
	abstract public function get_source();
	
	abstract public function make_line();

	abstract public function get_current_line();
	
	abstract public function make_char();
	
	abstract public function get_current_char();
	
}

