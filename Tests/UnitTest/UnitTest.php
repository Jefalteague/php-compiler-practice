<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use SymbolTable\Symbol_Table_Factory;

class test_compiler extends TestCase {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	// Crossreferencer Tests_________________________________________________________________________________________________


	// Symbol Table Factory Tests_________________________________________________________________________________________________

	/**
	 * Method test_that_symbol_table_factory_returns_stack_class
	 *
	 * @return void
	 */
	public function test_that_symbol_table_factory_returns_stack_class() {

		$stack = Symbol_Table_Factory::create_stack();

		$this->assertTrue(get_class($stack) == 'SymbolTable\Symbol_Table_Stack');

	}
	
	/**
	 * Method test_that_symbol_table_factory_returns_table_class
	 *
	 * @return void
	 */
	public function test_that_symbol_table_factory_returns_table_class() {

		$nesting_level = 0;

		$table = Symbol_Table_Factory::create_table($nesting_level);

		$this->assertTrue(get_class($table) == 'SymbolTable\Symbol_Table');

	}
	
	/**
	 * Method test_that_symbol_table_factory_returns_entry_class
	 *
	 * @return void
	 */
	public function test_that_symbol_table_factory_returns_entry_class() {

		$nesting_level = 0;

		$table = Symbol_Table_Factory::create_table($nesting_level);

		$name = 'alpha';

		$entry = Symbol_Table_Factory::create_entry($name, $table);

		$this->assertTrue(get_class($entry) == 'SymbolTable\Symbol_Table_Entry');

	}

}
