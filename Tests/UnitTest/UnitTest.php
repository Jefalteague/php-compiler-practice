<?php

namespace Tests;

use AST\ASTNode;
use AST\ASTFactory;
use AST\ASTNodeType;
use AST\ASTNodeTypeEnum;
use Token\Pascal_Token_Type;
use PHPUnit\Framework\TestCase;
use Token\My_Language_Error_Type;
use SymbolTable\Symbol_Table_Factory;

class TestCompiler extends TestCase {

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

	// AST Tests _____________________________________________________________________________

	// ASTNodeType Tests _____________________________________________________________________

	/**
	 * Method test_that_ASTNodeType_returns_ASTNodeType
	 *
	 * @return void
	 */
	public function test_that_ASTNodeType_returns_ASTNodeType() {

		$ast_node_type = new ASTNodeType;

		$this->assertTrue(get_class($ast_node_type) == 'AST\ASTNodeType');

	}

	// ASTNode Tests _________________________________________________________________________
	
	/**
	 * Method test_that_ASTNode_returns_ASTNode
	 *
	 * @return void
	 */
	public function test_that_ASTNode_returns_ASTNode() {

		$ast_node_type = ASTNodeTypeEnum::NOOP_STATEMENT;

		$ast_node = new ASTNode($ast_node_type);

		$this->assertTrue(get_class($ast_node) == 'AST\ASTNode');

	}

	// AST Factory Tests _____________________________________________________________________
	
	/**
	 * Method test_that_ASTFactory_create_AST_returns_AST
	 *
	 * @return void
	 */
	public function test_that_ASTFactory_create_AST_returns_AST() {

		$ast = ASTFactory::create_AST();

		$this->assertTrue(get_class($ast) == 'AST\AST');

	}
	
	/**
	 * Method test_that_ASTFactory_create_ASTNode_returns_ASTNode
	 *
	 * @return void
	 */
	public function test_that_ASTFactory_create_ASTNode_returns_ASTNode() {

		$ast_node_type = ASTNodeTypeEnum::NOOP_STATEMENT;

		$ast = ASTFactory::create_ASTNode($ast_node_type);

		$this->assertTrue(get_class($ast) == 'AST\ASTNode');

	}

	public function test_that_ASTNodeEnum_returns_ASTNodeEnum() {

		$enum = ASTNodeTypeEnum::IF_STATEMENT;

		$this->assertTrue(get_class($enum) == 'AST\ASTNodeTypeEnum');

	}

	public function test_that_pascal_token_type_reserved_keywords_returns_same_string() {

		$ptt = Pascal_Token_Type::BEGIN;

		$ptt = $ptt->reserved_words();

		$this->assertEquals($ptt, 'BEGIN');

	}

	public function test_that_pascal_toke_type_reserved_words_does_not_return_special_symbol() {

		$ptt = Pascal_Token_Type::BEGIN;

		$ptt = $ptt->reserved_words();

		$this->assertNotEquals($ptt, 'COLON');

	}

	public function test_that_pascal_token_type_special_symbols_returns_special_symbol() {

		$ptt = Pascal_Token_Type::COLON;

		$ptt = $ptt->special_symbols();

		$this->assertEquals($ptt, ':');

	}

	public function test_that_pascal_token_type_special_symbols_does_not_return_reserved_word() {

		$ptt = Pascal_Token_Type::COLON;

		$ptt = $ptt->special_symbols();

		$this->assertNotEquals($ptt, 'BEGIN');

	}

	public function test_My_Language_Error_Type_returns_Invalid_Character() {

		$et = My_Language_Error_Type::INVALID_CHARACTER;

		var_dump($et);
		die;

		$this->assertTrue($et == 'INVALID CHARACTER');

	}

}
