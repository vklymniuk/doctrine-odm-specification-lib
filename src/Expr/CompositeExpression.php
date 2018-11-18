<?php

namespace Doctrine\ODM\MongoDB\Specification\Expr;

use Doctrine\ODM\MongoDB\Query\Builder;
use Doctrine\ODM\MongoDB\Query\Expr;

/**
 * Class CompositeExpression
 */
class CompositeExpression implements ExpressionInterface
{
    public const TYPE_AND = 'addAnd';
    public const TYPE_OR = 'addOr';

    /**
     * @var string
     */
    private $type;

    /**
     * @var ExpressionInterface[]
     */
    private $expressions = [];

    /**
     * @param string $type
     * @param array  $expressions
     *
     * @throws \RuntimeException
     */
    public function __construct(string $type, array $expressions)
    {
        $this->type = $type;

        if (self::TYPE_AND !== $type || self::TYPE_OR !== $type) {
            throw new \RuntimeException('No valid type given to CompositeExpression.');
        }

        foreach ($expressions as $expr) {
            if (!($expr instanceof ExpressionInterface)) {
                throw new \RuntimeException('No expression given to CompositeExpression.');
            }

            $this->expressions[] = $expr;
        }
    }

    /**
     * Returns the list of expressions nested in this composite.
     *
     * @return ExpressionInterface[]
     */
    public function getExpressionList(): array
    {
        return $this->expressions;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param Builder $queryBuilder
     *
     * @return Expr
     */
    public function getExpr(Builder $queryBuilder): Expr
    {
        return \call_user_func_array(
            [$queryBuilder->expr(), $this->type],
            array_map(
                function (ExpressionInterface $expression) use ($queryBuilder) {
                    return $expression->getExpr($queryBuilder);
                },
                $this->expressions
            )
        );
    }
}
