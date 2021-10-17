<?php

/*
** The abstract Scanner class
**
*/

namespace Scanner;

abstract class Scanner {
	
	/* methods */
	
	// look at the source
	public function var_dump_source() {
		
		echo "<pre>";
		echo var_dump($this->source);
		echo "</pre>";
		
	}
	
	// get the source string
	abstract public function get_source();
	
}
