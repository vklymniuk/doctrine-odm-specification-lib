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
     * @return MatchSpecificationInterface
     */
    public function applyWhere(): MatchSpecificationInterface;

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

    /**
     * @param int $count
     *
     * @return MatchSpecificationInterface
     */
    public function limit(int $count): MatchSpecificationInterface;

    /**
     * @param int $count
     *
     * @return MatchSpecificationInterface
     */
    public function offset(int $count): MatchSpecificationInterface;

    /**
     * @param bool $eager
     *
     * @return MatchSpecificationInterface
     */
    public function eagerCursor(bool $eager): MatchSpecificationInterface;

    /**
     * @param bool $readOnly
     *
     * @return MatchSpecificationInterface
     */
    public function readOnly(bool $readOnly): MatchSpecificationInterface;

    /**
     * @param bool $refresh
     *
     * @return MatchSpecificationInterface
     */
    public function refresh(bool $refresh): MatchSpecificationInterface;
}
