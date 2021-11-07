<?php

/*
** The Message Class
**
**
*/

namespace Message;

class Message {

	// properties

	private $type;
	
	// DESCRIPTION OF MOD: add $data to properties

	// UNCOMMENT OUT TO TEST...
	private $data;

	// methods
	
	// DESCRIPTION OF MOD: add $data through __construct
	
	// COMMENT OUT TO TEST...
	//public function __construct($type) {
		
	//	$this->type = $type;
	
	//}
	
	// UNCOMMENT OUT TO TEST...
	public function __construct($type, $data) {
		
		$this->type = $type;
		
		$this->data = $data;
	
	}
	
	public function get_message_type() {
		
		return $this->type;
		
	}
	
	// DESCRIPTION OF MOD: add get_data()
		
	// UNCOMMENT OUT TO TEST...
	public function get_data() {return $this->data;}

}