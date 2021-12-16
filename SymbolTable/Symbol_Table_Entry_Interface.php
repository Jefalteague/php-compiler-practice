<?php

namespace SymbolTable;

interface Symbol_Table_Entry_Interface {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	/**
	 * Method get_entry_name
	 *
	 * @return string
	 */
	public function get_entry_name():string;
	
	/**
	 * Method get_symbol_table
	 *
	 * @return Symbol_Table
	 */
	public function get_symbol_table():Symbol_Table;


	/**
	 * Method set_attribute
	 *
	 * @param Symbol_Table_Key $key [the key to the attribute]
	 * @param $value $value [the value of the attribute]
	 *
	 * @return void
	 */
	public function set_attribute(Symbol_Table_Key $key, $value):void;
	
	/**
	 * Method get_attribute
	 *
	 * @param Symbol_Table_Key $key [the key to the attribute]
	 *
	 * @return void
	 */
	public function get_attribute(Symbol_Table_Key $key);
	
	/**
	 * Method append_line_number
	 *
	 * @param int $line_number [the line number of the identifier]
	 *
	 * @return void
	 */
	public function append_line_number(int $line_number):void;

	/**
	 * Method get_line_numbers
	 *
	 * @return Array
	 */
	public function get_line_numbers():Array;

}
