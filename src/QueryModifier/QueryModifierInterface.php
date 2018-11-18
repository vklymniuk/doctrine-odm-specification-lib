<?php

namespace Doctrine\ODM\MongoDB\Specification\QueryModifier;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Interface QueryModifierInterface
 */
interface QueryModifierInterface
{
    /**
     * @param Builder $queryBuilder
     */
    public function modify(Builder $queryBuilder): void;
}
