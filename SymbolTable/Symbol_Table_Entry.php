<?php

namespace SymbolTable;

use SymbolTable\Symbol_Table as Symbol_table;
use SymbolTable\Symbol_Table_Entry_Interface;

class Symbol_Table_Entry implements Symbol_Table_Entry_Interface {

	/*Properties
	**
	**
	*/
	
	/**
	 * name
	 *
	 * @var string
	 */
	private $name;	

	/**
	 * symbol_table
	 *
	 * @var Symbol_Table
	 */
	private $symbol_table;

	/**
	 * line_numbers
	 *
	 * @var array
	 */
	private array $line_numbers = array();
	
	/**
	 * attributes
	 *
	 * @var array
	 */
	private array $attributes = array();

	/*Methods
	**
	**
	*/
	
	/**
	 * Method __construct
	 *
	 * @param string $name [explicite description]
	 * @param Symbol_Table $symbol_table [explicite description]
	 *
	 * @return void
	 */
	public function __construct(string $name, Symbol_Table $symbol_table) {

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
	 * Method set_attribute
	 *
	 * @param Symbol_Table_Key $key [the key to the attribute]
	 * @param $value $value [explicite description]
	 *
	 * @return void
	 */

	public function set_attribute(Symbol_Table_Key $key, $value):void {

		$attribute = $this->attributes[$key] = $value;

	}
	
	/**
	 * Method get_attribute
	 *
	 * @param Symbol_Table_Key $key [the key to the attribute]
	 *
	 * @return void
	 */

	public function get_attribute(Symbol_Table_Key $key) {

		$attribute = $this->attributes[$key];

		return $attribute;

	}
	
	/**
	 * Method append_line_number
	 *
	 * @param int $line_number [the line number of the identifier]
	 *
	 * @return void
	 */
	
	public function append_line_number(int $line_number):void {

		$this->line_numbers[] = $line_number;

	}

	/**
	 * Method get_line_numbers
	 *
	 * @return Array
	 */
	public function get_line_numbers():Array {}

}
