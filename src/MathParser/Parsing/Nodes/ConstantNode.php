<?php namespace MathParser\Parsing\Nodes;

use MathParser\Interpreting\Visitors\Visitor;

class ConstantNode extends Node
{
    private $value;

    function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitConstantNode($this);
    }
}
