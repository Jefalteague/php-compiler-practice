<?php

namespace Parser;

use Parser\My_Language_Parser as My_Language_Parser;
use Parser\Statement_Parser as Statement_Parser;

class Statement_Parser extends My_language_Parser{

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	public function __construct(My_Language_Parser $parent) {

		return parent::get_parent_scanner($parent);

	}

	public function parse() {

		

	}

}