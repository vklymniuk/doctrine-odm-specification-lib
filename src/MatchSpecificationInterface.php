<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\MongoDB\Query\Expr;
use Doctrine\ODM\MongoDB\Query\Builder;
use Doctrine\ODM\MongoDB\Specification\QueryModifier\QueryModifierInterface;

/**
 * Interface MatchSpecificationInterface
 */
interface MatchSpecificationInterface
{
    /**
     * Gets the expression attached to this Specification.
     *
     * @return Expr|null
     */
    public function getExpression(): ?Expr;

    /**
     * Gets the expression attached to this Specification.
     *
     * @return QueryModifierInterface[]
     */
    public function getQueryModifiers(): array;

    /**
     * @param Builder $builder
     *
     * @return MatchSpecificationInterface
     */
    public function applyWhere(Builder $builder): MatchSpecificationInterface;

    /**
     * @param Builder $builder
     *
     * @return MatchSpecificationInterface
     */
    public function applySort(Builder $builder): MatchSpecificationInterface;

    /**
     * @param Builder $builder
     *
     * @return MatchSpecificationInterface
     */
    public function applyQueryOptions(Builder $builder): MatchSpecificationInterface;
}
