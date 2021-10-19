<?php

namespace Apple;

class Apple {

	public $bob;

	public function __construct() {
	
		$this->bob = "hello there Apple";
	
	}
	
	public function get_bob() {
		
		return $this->bob;
		
	}

}