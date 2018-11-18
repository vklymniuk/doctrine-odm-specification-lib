<?php

namespace Doctrine\ODM\MongoDB\Specification\QueryModifier;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Class Limit
 */
class Limit implements QueryModifierInterface
{
    /**
     * @var int limit
     */
    private $limit;

    /**
     * @param int $limit
     */
    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * @param Builder $queryBuilder
     */
    public function modify(Builder $queryBuilder): void
    {
        $queryBuilder->limit($this->limit);
    }
}
