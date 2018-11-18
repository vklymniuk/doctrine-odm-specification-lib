<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\ODM\MongoDB\Specification\Expr;
use Doctrine\ODM\MongoDB\Specification\QueryModifier;
use Doctrine\ODM\MongoDB\Specification\ResultModifier;

/**
 * Class BaseSpecification
 */
abstract class Specification implements SpecificationInterface
{
    /**
     * @var QueryModifier\QueryModifierInterface[]
     */
    protected $queryModifiers = [];

    /**
     * @var ResultModifier\ResultModifierInterface[]
     */
    protected $resultModifiers = [];

    /**
     * @var Expr\ExpressionInterface
     */
    protected $expression;

    /**
     * @var Expr\ExpressionBuilder
     */
    private static $expressionBuilder;

    /**
     * Returns the expression builder.
     *
     * @return Expr\ExpressionBuilder
     */
    public static function expr(): Expr\ExpressionBuilder
    {
        if (self::$expressionBuilder === null) {
            self::$expressionBuilder = new Expr\ExpressionBuilder();
        }

        return self::$expressionBuilder;
    }

    /**
     * @inheritdoc
     */
    public function where(Expr\ExpressionInterface $expression): SpecificationInterface
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function andWhere(Expr\ExpressionInterface $expression): SpecificationInterface
    {
        if ($this->expression === null) {
            return $this->where($expression);
        }

        $this->expression = new Expr\CompositeExpression(Expr\CompositeExpression::TYPE_AND, [
            $this->expression,
            $expression,
        ]);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function orWhere(Expr\ExpressionInterface $expression): SpecificationInterface
    {
        if ($this->expression === null) {
            return $this->where($expression);
        }

        $this->expression = new Expr\CompositeExpression(Expr\CompositeExpression::TYPE_OR, [
            $this->expression,
            $expression,
        ]);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getWhereExpression(): ?Expr\ExpressionInterface
    {
        return $this->expression;
    }

    /**
     * @inheritdoc
     */
    public function getQueryModifiers(): array
    {
        return $this->queryModifiers;
    }

    /**
     * @inheritdoc
     */
    public function limit(int $count): SpecificationInterface
    {
        $this->queryModifiers[] = new QueryModifier\Limit($count);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function offset(int $count): SpecificationInterface
    {
        $this->queryModifiers[] = new QueryModifier\Offset($count);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function sortBy(string $field, int $order = 1): SpecificationInterface
    {
        $this->queryModifiers[] = new QueryModifier\SortBy($field, $order);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function eagerCursor(bool $eager): SpecificationInterface
    {
        $this->resultModifiers[] = new ResultModifier\EagerCursor($eager);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function readOnly(bool $readOnly): SpecificationInterface
    {
        $this->resultModifiers[] = new ResultModifier\ReadOnly($readOnly);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function refresh(bool $refresh): SpecificationInterface
    {
        $this->resultModifiers[] = new ResultModifier\Refresh($refresh);

        return $this;
    }
}
