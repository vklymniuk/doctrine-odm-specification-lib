<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\ODM\MongoDB\Specification\Expr\ExpressionInterface;
use Doctrine\ODM\MongoDB\Specification\QueryModifier\QueryModifierInterface;

/**
 * Interface SpecificationInterface
 */
interface SpecificationInterface
{
    /**
     * Sets the where expression to evaluate when this Specification is searched for.
     *
     * @param ExpressionInterface $expression
     *
     * @return $this
     */
    public function where(ExpressionInterface $expression): SpecificationInterface;

    /**
     * Appends the where expression to evaluate when this Specification is searched for
     * using an AND with previous expression.
     *
     * @param ExpressionInterface $expression
     *
     * @return $this
     */
    public function andWhere(ExpressionInterface $expression): SpecificationInterface;

    /**
     * Appends the where expression to evaluate when this Specification is searched for
     * using an OR with previous expression.
     *
     * @param ExpressionInterface $expression
     *
     * @return $this
     */
    public function orWhere(ExpressionInterface $expression): SpecificationInterface;

    /**
     * Gets the expression attached to this Specification.
     *
     * @return ExpressionInterface|null
     */
    public function getWhereExpression(): ?ExpressionInterface;

    /**
     * Gets the expression attached to this Specification.
     *
     * @return QueryModifierInterface[]
     */
    public function getQueryModifiers(): array;

    /**
     * @param int $count
     *
     * @return $this
     */
    public function limit(int $count): SpecificationInterface;

    /**
     * @param int $count
     *
     * @return $this
     */
    public function offset(int $count): SpecificationInterface;

    /**
     * @param string $field
     * @param int    $order
     *
     * @return Specification
     */
    public function sortBy(string $field, int $order = 1): SpecificationInterface;

    /**
     * @param bool $eager
     *
     * @return SpecificationInterface
     */
    public function eagerCursor(bool $eager): SpecificationInterface;

    /**
     * @param bool $readOnly
     *
     * @return SpecificationInterface
     */
    public function readOnly(bool $readOnly): SpecificationInterface;

    /**
     * @param bool $refresh
     *
     * @return SpecificationInterface
     */
    public function refresh(bool $refresh): SpecificationInterface;
}
