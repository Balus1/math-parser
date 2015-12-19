<?php namespace MathParser\Interpreting;

use MathParser\Interpreting\Visitors\Visitor;
use MathParser\Parsing\Nodes\ExpressionNode;
use MathParser\Parsing\Nodes\NumberNode;
use MathParser\Parsing\Nodes\VariableNode;
use MathParser\Parsing\Nodes\FunctionNode;
use MathParser\Parsing\Nodes\ConstantNode;


class PrettyPrinter implements Visitor
{
    public function visitExpressionNode(ExpressionNode $node)
    {
        $leftValue = $node->getLeft()->accept($this);
        $operator = $node->getOperator();

        // The operator and the right side are optional, remember?
        if (!$operator)
            return "$leftValue";

        $rightValue = $node->getRight()->accept($this);

        return "($operator, $leftValue, $rightValue)";

    }

    public function visitNumberNode(NumberNode $node)
    {
        return $node->getValue();
    }

    public function visitVariableNode(VariableNode $node)
    {
        return $node->getName();
    }

    public function visitFunctionNode(FunctionNode $node)
    {
        $functionName = $node->getName();
        $operand = $node->getOperand()->accept($this);

        return "$functionName($operand)";
    }

    public function visitConstantNode(ConstantNode $node)
    {
        return $node->getValue();
    }
}
