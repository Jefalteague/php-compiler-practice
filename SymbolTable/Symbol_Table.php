<?php

namespace SymbolTable;

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
	private array $entries = array();
	
	/**
	 * nesting_level
	 *
	 * @var int
	 */
	private int $nesting_level;

	/*Methods
	**
	**
	*/
	
	/**
	 * Method __construct
	 *
	 * @param int $nesting_level [the scope level for the table]
	 *
	 * @return void
	 */
	public function __construct(int $nesting_level) {

		$this->nesting_level = $nesting_level;

	}

		
	/**
	 * Method get_nesting_level
	 *
	 * @return int
	 */
	public function get_nesting_level():int {

		return $this->nesting_level;

	}
	
	/**
	 * Method enter
	 *
	 * @param string $name [the name of the identifier]
	 *
	 * @return Symbol_Table_Entry
	 */
	public function enter(string $name):Symbol_Table_Entry {

		$entry = Symbol_Table_Factory::create_entry($name, $this);

		$this->entries[$name] = $entry;

		return $entry;

	}
	
	/**
	 * Method lookup
	 *
	 * @param string $name [the name of the identifier]
	 *
	 * @return Symbol_Table_Entry
	 */
	public function lookup(string $name):Symbol_Table_Entry|NULL {

		if(array_key_exists($name, $this->entries)) {

			return $this->entries[$name];

		} else {

			return NULL;

		}

	}
	
	/**
	 * Method list
	 *
	 * @return Array
	 */
	public function list():Array {

		return $this->entries;

	}

}
