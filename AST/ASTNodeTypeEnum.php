<?php

namespace AST;

enum ASTNodeTypeEnum implements ASTNodeTypeEnumInterface {

	/*Properties
	**
	**
	*/

	// STRUCTURE

	case PROGRAM;
	case PROCEDURE;
	case FUNCTION;
	case BLOCK;

	// STATEMENTS

	case COMPOUND_STATEMENT;
	case ASSIGNMENT_STATEMENT;
	case PROCEDURES_STATEMENT;
	case IF_STATEMENT;
	case SELECT_STATEMENT;
	case SELECT_BRANCH_STATEMENT;
	case LOOP_STATEMENT;
	case SELECT_CONSTANTS_STATEMENT;
	case NOOP_STATEMENT;
	case TEST_STATEMENT;
	case CALL_STATEMENT;
	case PARAMETERS_STATEMENT;
	case WHILE_STATEMENT;
	
	//ADD, SUBTRACT, OR, NEGATE

	case ADD_OPERATOR;
	case SUBTRACT_OPERATOR;
	case OR_OPERATOR;
	case NEGATE_OPERATOR;

	// MULTIPLY, INTEGER DIVIDE, FLOAT DIVIDE, MODULUS, AND

	case MULTIPLICATION_OPERATOR;
	case INTEGER_DIVISION_OPERATOR;
	case FLOAT_DIVISION_OPERATOR;
	case MODULUS_OPERATOR;
	case AND_OPERATOR;

	// EQUAL, NOT EQUAL, LESS THAN, LESS THAN EQUAL, GREATER THAN, GREATER THAN EQUAL

	case EQUAL_OPERATOR;
	case NOT_EQUAL_OPERATOR;
	case LESS_THAN_OPERATOR;
	case LESS_THAN_EQUAL_OPERATOR;
	case GREATER_THAN_OPERATOR;
	case GREATER_THAN_EQUAL_OPERATOR;

	// OPERANDS

	case VARIABLE_OPERAND;
	case SUBSCRIPTS_OPERAND;
	case FIELD_OPERAND;
	case BOOLEAN_CONSTANT_OPERAND;
	case INTEGER_CONSTANT_OPERAND;
	case REAL_CONSTANT_OPERAND;
	case STRING_CONSTANT_OPERAND;

	// OTHER
	


	/*Methods
	**
	**
	*/

	

}
