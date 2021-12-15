<?php

namespace SymbolTable;

use SymbolTable\Symbol_Table;
use SymbolTable\Symbol_Table_Entry;
use SymbolTable\Symbol_Table_Factory;
use SymbolTable\Symbol_Table_Stack_Interface;

class Symbol_Table_Stack implements Symbol_Table_Stack_Interface {

	/*Properties
	**
	**
	*/
	
	/**
	 * stack
	 *
	 * @var array for now
	 */
	private $stack = array();
	
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

	public function __construct() {

		$this->nesting_level = 0;

		$this->stack[] = Symbol_Table_Factory::create_table($this->nesting_level);

	}
		
	/**
	 * Method get_current_nesting_level
	 *
	 * @return int
	 */
	public function get_current_nesting_level():int {

		return $this->nesting_level;

	}
		
	/**
	 * Method enter_local
	 *
	 * @param $name $name [explicit description]
	 *
	 * @return Symbol_Table_Entry
	 */
	public function enter_local($name):Symbol_Table_Entry {

		$table = $this->stack[$this->nesting_level];

		$entry = $table->enter($name);

		return $entry;

	}
	
	/**
	 * Method lookup_local
	 *
	 * @param $name $name [explicit description]
	 *
	 * @return Symbol_Table_Entry
	 */
	public function lookup_local($name):Symbol_Table_Entry|NULL {

		$table = $this->stack[$this->nesting_level];

		$entry = $table->lookup($name);

		if($entry) {

			return $entry;

		} else {

			return NULL;

		}


	}
	
	/**
	 * Method lookup
	 *
	 * @param $name $name [explicite description]
	 *
	 * for now only capable of returning lookup_local()
	 * @return Symbol_Table_Entry
	 */
	public function lookup($name):Symbol_Table_Entry|NULL {

		$entry = $this->lookup_local($name);

		return $entry;

	}

	/**
	 * Method get_local_symbtab
	 *
	 * @return Symbol_Table
	 */
	public function get_local_symbtab():Symbol_Table {

		$table = $this->stack[$this->nesting_level];

	}

}
