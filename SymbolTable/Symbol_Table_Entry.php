<?php

namespace SymbolTable;

use SymbolTable\Symbol_Table_Entry_Interface;

class Symbol_Table_Entry implements Symbol_Table_Entry_Interface {

	/*Properties
	**
	**
	*/
	
	/**
	 * name
	 *
	 * @var mixed
	 */
	private $name;	

	/**
	 * symbol_table
	 *
	 * @var mixed
	 */
	private $symbol_table;

	/**
	 * line_numbers
	 *
	 * @var mixed
	 */
	private $line_numbers = array();
	
	/**
	 * attributes
	 *
	 * @var array
	 */
	private $attributes = array();

	/*Methods
	**
	**
	*/

	public function __construct($name, $symbol_table) {

		$this->name = $name;

		$this->symbol_table = $symbol_table;

	}

	/**
	 * Method get_entry_name
	 *
	 * @return string
	 */
	public function get_entry_name():string {

		return $this->name;

	}
	
	/**
	 * Method get_symbol_table
	 *
	 * @return Symbol_Table
	 */
	public function get_symbol_table():Symbol_Table {

		return $this->symbol_table;

	}

	/**
	 * Method set_atribute
	 *
	 * @return void
	 */
	public function set_attribute($key, $value):void {

		$attribute = $this->attributes[$key] = $value;

	}
	
	/**
	 * Method get_attribute
	 *
	 * @return void
	 */
	public function get_attribute($key)/*:return type?*/ {

		$attribute = $this->attributes[$key];

		return $attribute;

	}
	
	/**
	 * Method append_line_number
	 *
	 * @return void
	 */
	public function append_line_number($line_numbers):void {

		$this->line_numbers[] = $line_numbers;

	}

	/**
	 * Method get_line_numbers
	 *
	 * @return Array
	 */
	public function get_line_numbers():Array {}

}
