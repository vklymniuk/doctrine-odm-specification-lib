<?php

namespace Doctrine\ODM\MongoDB\Specification\QueryModifier;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Class Offset
 */
class Offset implements QueryModifierInterface
{
    /**
     * @var int offset
     */
    private $offset;

    /**
     * @param int $offset
     */
    public function __construct(int $offset)
    {
        $this->offset = $offset;
    }

    /**
     * @param Builder $queryBuilder
     */
    public function modify(Builder $queryBuilder): void
    {
        $queryBuilder->skip($this->offset);
    }
}
