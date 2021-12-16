<?php

namespace SymbolTable;

interface Symbol_Table_Stack_Interface {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/
	
	/**
	 * Method get_current_nesting_level
	 *
	 * @return int
	 */
	public function get_current_nesting_level():int;
	
	/**
	 * Method lookup_local
	 *
	 * @param $name $name [explicit description]
	 *
	 * @return Symbol_Table_Entry
	 */	
	public function lookup_local($name):Symbol_Table_Entry|NULL;
	
	/**
	 * Method enter_local
	 *
	 * @param $name $name [explicit description]
	 *
	 * @return Symbol_Table_Entry
	 */
	public function enter_local($name):Symbol_Table_Entry;
	
	/**
	 * Method lookup
	 *
	 * @param $name $name [explicite description]
	 *
	 * @return Symbol_Table_Entry
	 */
	public function lookup($name):Symbol_Table_Entry|NULL;

	/**
	 * Method get_local_symbtab
	 *
	 * @return Symbol_Table
	 */
	public function get_local_symbol_table():Symbol_Table;

}
