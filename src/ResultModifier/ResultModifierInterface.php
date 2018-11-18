<?php

namespace Doctrine\ODM\MongoDB\Specification\ResultModifier;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Interface ResultModifierInterface
 */
interface ResultModifierInterface
{
    /**
     * @param Builder $query
     */
    public function modify(Builder $query): void;
}
