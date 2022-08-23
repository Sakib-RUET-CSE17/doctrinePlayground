<?php

namespace App\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

/**
 * JsonQuery ::= "JsonQuery" "(" StringPrimary "," StringPrimary ")"
 */
class JsonQuery extends FunctionNode
{
    // (1)
    public $fieldName = null;
    public $value = null;

    public function __construct()
    {
        dd($this->fieldName, $this->value);
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        dd($this->fieldName, $this->value);
        $parser->match(Lexer::T_IDENTIFIER); // (2)
        $parser->match(Lexer::T_OPEN_PARENTHESIS); // (3)
        $this->fieldName = $parser->StringPrimary(); // (4)
        $parser->match(Lexer::T_COMMA); // (5)
        $this->value = $parser->StringPrimary(); // (6)
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // (3)

    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        dd($this->fieldName, $this->value);
        return "data->>'" .
            $this->fieldName->dispatch($sqlWalker) . "' like '" .
            $this->value->dispatch($sqlWalker) .
            "'"; // (7)
    }
}
