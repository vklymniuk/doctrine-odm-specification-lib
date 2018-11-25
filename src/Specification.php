<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\MongoDB\Query\Expr;
use Doctrine\ODM\MongoDB\Query\Builder;
use Doctrine\ODM\MongoDB\Specification\QueryModifier;
use Doctrine\ODM\MongoDB\Specification\ResultModifier;

/**
 * Class BaseSpecification
 */
abstract class Specification implements MatchSpecificationInterface
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
     * @var Expr
     */
    private $expression;

    /**
     * Returns the expression builder.
     *
     * @return Expr
     */
    public function expr(): Expr
    {
        if ($this->expression === null) {
            $this->expression = new Expr();
        }

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
    public function limit(int $count): MatchSpecificationInterface
    {
        $this->queryModifiers[] = new QueryModifier\Limit($count);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function offset(int $count): MatchSpecificationInterface
    {
        $this->queryModifiers[] = new QueryModifier\Offset($count);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function eagerCursor(bool $eager): MatchSpecificationInterface
    {
        $this->resultModifiers[] = new ResultModifier\EagerCursor($eager);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function readOnly(bool $readOnly): MatchSpecificationInterface
    {
        $this->resultModifiers[] = new ResultModifier\ReadOnly($readOnly);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function refresh(bool $refresh): MatchSpecificationInterface
    {
        $this->resultModifiers[] = new ResultModifier\Refresh($refresh);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getExpression(): ?Expr
    {
        return $this->expression;
    }

    /**
     * @inheritdoc
     */
    public function applyWhere(): MatchSpecificationInterface
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function applySort(Builder $builder): MatchSpecificationInterface
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function applyQueryOptions(Builder $builder): MatchSpecificationInterface
    {
        return $this;
    }
}
