<?php

namespace SymbolTable;

use SymbolTable\Symbol_Table_Entry;

interface Symbol_Table_Interface {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	/**
	 * Method get_nesting_level
	 *
	 * @return int
	 */
	public function get_nesting_level():int;

	/**
	 * Method enter
	 *
	 * @return Symbol_Table_Entry
	 */
	public function enter(string $name):Symbol_Table_Entry|NULL;

	/**
	 * Method lookup
	 *
	 * @return Symbol_Table_Entry
	 */
	public function lookup(string $name):Symbol_Table_Entry|NULL;
	
	/**
	 * Method list
	 *
	 * @return Array
	 */
	public function list():Array;

}
