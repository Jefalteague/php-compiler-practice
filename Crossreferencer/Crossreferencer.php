<?php

namespace Crossreferencer;

use SymbolTable\Symbol_Table_Stack;

class Crossreferencer {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	public function crossreference(Symbol_Table_Stack $stack) {

		$list = $stack->get_local_symbol_table()->list();

		foreach($list as $item) {
		
			foreach($item as $i) {

				//$this->header($i);
		
				echo "<pre>";
				echo $i->get_entry_name();
				echo "</br>";
		
			}
		
		}

	}

	public function header($i) {

		//this will be for formatting the output strings
		$length = strlen($i->get_entry_name());
		$bob='-';
		echo sprintf("%'-{$length}s", $bob);

	}

}
