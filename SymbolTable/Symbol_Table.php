<?php

namespace SymbolTable;

use SymbolTable\Symbol_Table_Interface;

class Symbol_Table implements Symbol_Table_Interface {

	/*Properties
	**
	**
	*/
	
	/**
	 * table
	 *
	 * @var array for now
	 */
	private $entries = array();
	
	/**
	 * nesting_level
	 *
	 * @var mixed
	 */
	private $nesting_level;

	/*Methods
	**
	**
	*/

	public function __construct(int $nesting_level) {

		$this->nesting_level = $nesting_level;

	}

	
	public function get_nesting_level():int {

		return $this->nesting_level;

	}

	public function enter(string $name):Symbol_Table_Entry {

		$entry = Symbol_Table_Factory::create_entry($name, $this);

		$entries[$name] = $entry;

		return $entry;

	}

	public function lookup(string $name):Symbol_Table_Entry|NULL {

		//$entry = $this->entries[$name];

		if(array_search($name, $this->entries)) {

			return $entry;

		} else {

			return NULL;

		}

	}

	public function list():Array {



	}


}
