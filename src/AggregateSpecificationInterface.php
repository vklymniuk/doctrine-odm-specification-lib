<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\MongoDB\Aggregation\Builder;
use Doctrine\MongoDB\Iterator;

/**
 * Interface AggregateSpecificationInterface
 */
interface AggregateSpecificationInterface
{
    /**
     * @param Builder $builder
     *
     * @return Iterator
     */
    public function aggregate(Builder $builder): Iterator;
}
