<?php

namespace SymbolTable;

class Symbol_Table_Factory {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	/**
	 * Method create_stack
	 *
	 * @return Symbol_Table_Stack
	 */
	public static function create_stack():Symbol_Table_Stack {

		return new Symbol_Table_Stack;

	}
	
	/**
	 * Method create_table
	 *
	 * @param int $nesting_level [explicite description]
	 *
	 * @return Symbol_Table
	 */
	public static function create_table(int $nesting_level):Symbol_Table {

		return new Symbol_Table($nesting_level);

	}

	/**
	 * Method create_entry
	 *
	 * @param string $name [explicite description]
	 * @param Symbol_Table $symbol_table [explicite description]
	 *
	 * @return Symbol_Table_Entry
	 */
	public static function create_entry(string $name, Symbol_Table $symbol_table):Symbol_Table_Entry {

		return new Symbol_Table_Entry($name, $symbol_table);

	}

}
