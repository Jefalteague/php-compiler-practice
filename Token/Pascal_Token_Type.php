<?php

namespace Token;

enum Pascal_Token_Type:string implements Token_Type_Interface {

	/*Properties
	**
	**
	*/

	// Reserved Words
	case AND = 'AND';
	case ARRAY = 'ARRAY';
	case ASSIGN = 'ASSIGN';
	case BEGIN = 'BEGIN';
	case CASE = 'CASE';
	case CONST = 'CONST';
	case DIV = 'DIV';
	case DO = 'DO';
	case DOWNTO = 'DOWNTO';
	case ELSE = 'ELSE';
	case END = 'END';
	case FILE = 'FILE';
	case FOR = 'FOR';
	case FUNCTION = 'FUNCTION';
	case GOTO = 'GOTO';
	case IF = 'IF';
	case IN = 'IN';
	case LABEL = 'LABEL';
	case MOD = 'MOD';
	case NIL = 'NIL';
	case NOT = 'NOT';
	case OF = 'OF';
	case OR = 'OR';
	case PACKED = 'PACKED';
	case PROCEDURE = 'PROCEDURE';
	case PROGRAM = 'PROGRAM';
	case RECORD = 'RECORD';
	case REPEAT = 'REPEAT';
	case SET = 'SET';
	case THEN = 'THEN';
	case TO = 'TO';
	case TYPE = 'TYPE';
	case UNTIL = 'UNTIL';
	case VAR = 'VAR';
	case WHILE = 'WHILE';
	case WITH = 'WITH';

	// Not Reserved
	case IDENTIFIER = 'IDENTIFIER';
	case INTEGER = 'INTEGER';
	case REAL = 'REAL';
	case STRING = 'STRING';
	case ERROR = 'ERROR';
	case END_OF_FILE = 'END_OF_FILE';
	case EOF = 'EOF';
	case EOL = 'EOL';
	
	// Special Symbols
	case COLON = ':';
	case COLON_EQUALS = ':=';
	case SEMI_COLON = ';';
	case COMMA = ',';
	case DOT = '.';
	case DOT_DOT = '..';
	case EQUALS = '=';
	case LEFT_BRACE = '{';
	case LEFT_BRACKET = '[';
	case LEFT_PARENTHESES = '(';
	case LESS_EQUALS = '<=';
	case LESS_THAN = '<';
	case GREATER_EQUALS = '>=';
	case GREATER_THAN = '>';
	case MINUS = '-';
	case NOT_EQUALS = '<>';
	case PLUS = '+';
	case QUOTE = '\'';
	case RIGHT_BRACE = '}';
	case RIGHT_BRACKET = ']';
	case RIGHT_PARENTHESES = ')';
	case SLASH = '/';
	case STAR = '*';
	case UP_ARROW = '^';

	/*Methods
	**
	**
	*/

	public function reserved_words() {

		return match($this) {

			PASCAL_TOKEN_TYPE::AND => 'AND',
			PASCAL_TOKEN_TYPE::ARRAY => 'ARRAY',
			PASCAL_TOKEN_TYPE::ASSIGN => 'ASSIGN',
			PASCAL_TOKEN_TYPE::BEGIN => 'BEGIN',
			PASCAL_TOKEN_TYPE::CASE => 'CASE',
			PASCAL_TOKEN_TYPE::CONST => 'CONST',
			PASCAL_TOKEN_TYPE::DIV => 'DIV',
			PASCAL_TOKEN_TYPE::DO => 'DO',
			PASCAL_TOKEN_TYPE::DOWNTO => 'DOWNTO',
			PASCAL_TOKEN_TYPE::ELSE => 'ELSE',
			PASCAL_TOKEN_TYPE::END => 'END',
			PASCAL_TOKEN_TYPE::FILE => 'FILE',
			PASCAL_TOKEN_TYPE::FOR => 'FOR',
			PASCAL_TOKEN_TYPE::FUNCTION => 'FUNCTION',
			PASCAL_TOKEN_TYPE::GOTO => 'GOTO',
			PASCAL_TOKEN_TYPE::IF => 'IF',
			PASCAL_TOKEN_TYPE::IN => 'IN',
			PASCAL_TOKEN_TYPE::LABEL => 'LABEL',
			PASCAL_TOKEN_TYPE::MOD => 'MOD',
			PASCAL_TOKEN_TYPE::NIL => 'NIL',
			PASCAL_TOKEN_TYPE::NOT => 'NOT',
			PASCAL_TOKEN_TYPE::OF => 'OF',
			PASCAL_TOKEN_TYPE::OR => 'OR',
			PASCAL_TOKEN_TYPE::PACKED => 'PACKED',
			PASCAL_TOKEN_TYPE::PROCEDURE => 'PROCEDURE',
			PASCAL_TOKEN_TYPE::PROGRAM => 'PROGRAM',
			PASCAL_TOKEN_TYPE::RECORD => 'RECORD',
			PASCAL_TOKEN_TYPE::REPEAT => 'REPEAT',
			PASCAL_TOKEN_TYPE::SET => 'SET',
			PASCAL_TOKEN_TYPE::THEN => 'THEN',
			PASCAL_TOKEN_TYPE::TO => 'TO',
			PASCAL_TOKEN_TYPE::TYPE => 'TYPE',
			PASCAL_TOKEN_TYPE::UNTIL => 'UNTIL',
			PASCAL_TOKEN_TYPE::VAR => 'VAR',
			PASCAL_TOKEN_TYPE::WHILE => 'WHILE',
			PASCAL_TOKEN_TYPE::WITH => 'WITH',

		};

	}

	public function special_symbols() {

		return match($this) {

			PASCAL_TOKEN_TYPE::COLON => ':',
			PASCAL_TOKEN_TYPE::COLON_EQUALS => ':=',
			PASCAL_TOKEN_TYPE::COMMA => ',',
			PASCAL_TOKEN_TYPE::DOT => '.',
			PASCAL_TOKEN_TYPE::DOT_DOT => '..',
			PASCAL_TOKEN_TYPE::EQUALS => '=',
			PASCAL_TOKEN_TYPE::LEFT_BRACE => '{',
			PASCAL_TOKEN_TYPE::LEFT_BRACKET => '[',
			PASCAL_TOKEN_TYPE::LEFT_PARENTHESES => '(',
			PASCAL_TOKEN_TYPE::LESS_EQUALS => '<=',
			PASCAL_TOKEN_TYPE::LESS_THAN => '<',
			PASCAL_TOKEN_TYPE::GREATER_EQUALS => '>=',
			PASCAL_TOKEN_TYPE::GREATER_THAN => '>',
			PASCAL_TOKEN_TYPE::MINUS => '-',
			PASCAL_TOKEN_TYPE::NOT_EQUALS => '<>',
			PASCAL_TOKEN_TYPE::PLUS => '+',
			PASCAL_TOKEN_TYPE::QUOTE => '\'',
			PASCAL_TOKEN_TYPE::RIGHT_BRACE => '}',
			PASCAL_TOKEN_TYPE::RIGHT_BRACKET => ']',
			PASCAL_TOKEN_TYPE::RIGHT_PARENTHESES => ')',
			PASCAL_TOKEN_TYPE::SEMI_COLON => ';',
			PASCAL_TOKEN_TYPE::SLASH => '/',
			PASCAL_TOKEN_TYPE::STAR => '*',
			PASCAL_TOKEN_TYPE::UP_ARROW => '^',

		};

	}

	public function not_reserved() {

		return match($this) {
			
			PASCAL_TOKEN_TYPE::IDENTIFIER => 'IDENTIFIER',
			PASCAL_TOKEN_TYPE::INTEGER => 'INTEGER',
			PASCAL_TOKEN_TYPE::REAL => 'REAL',
			PASCAL_TOKEN_TYPE::STRING => 'STRING',
			PASCAL_TOKEN_TYPE::ERROR => 'ERROR',
			PASCAL_TOKEN_TYPE::END_OF_FILE => 'END_OF_FILE',
			PASCAL_TOKEN_TYPE::EOF => 'EOF',
			PASCAL_TOKEN_TYPE::EOL => 'EOL'

		};

	}

	public function rel_ops() {

		return match($this) {

			PASCAL_TOKEN_TYPE::GREATER_THAN => 'GREATER_THAN',
			PASCAL_TOKEN_TYPE::GREATER_EQUALS => 'GREATER_EQUALS',
			PASCAL_TOKEN_TYPE::LESS_THAN => 'LESS_THAN',
			PASCAL_TOKEN_TYPE::LESS_EQUALS => 'LESS_EQUALS',
			PASCAL_TOKEN_TYPE::EQUALS => 'EQUALS',
			PASCAL_TOKEN_TYPE::NOT_EQUALS => 'NOT_EQUALS',

		};

	}

}
