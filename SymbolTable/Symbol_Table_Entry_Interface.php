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
	 * Method set_atribute
	 *
	 * @return void
	 */
	public function set_attribute($key, $value):void;
	
	/**
	 * Method get_attribute
	 *
	 * @return void
	 */
	public function get_attribute($key)/*:return type?*/;
	
	/**
	 * Method append_line_number
	 *
	 * @return void
	 */
	public function append_line_number($line_number):void;

	/**
	 * Method get_line_numbers
	 *
	 * @return Array
	 */
	public function get_line_numbers():Array;

}
