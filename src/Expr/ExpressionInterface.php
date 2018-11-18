<?php

namespace Doctrine\ODM\MongoDB\Specification\Expr;

use Doctrine\ODM\MongoDB\Query\Builder;
use Doctrine\ODM\MongoDB\Query\Expr;

/**
 * Interface ExpressionInterface
 */
interface ExpressionInterface
{
    /**
     * @param Builder $queryBuilder
     *
     * @return Expr
     */
    public function getExpr(Builder $queryBuilder): Expr;
}
