<?php

namespace Doctrine\ODM\MongoDB\Specification\QueryModifier;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Class SortBy
 */
class SortBy implements QueryModifierInterface
{
    /**
     * @var string|string[]
     */
    private $fieldName;

    /**
     * @var int
     */
    private $order;

    /**
     * OrderBy constructor.
     *
     * @param string[]|string $fieldName
     * @param int             $order
     */
    public function __construct($fieldName, int $order = 1)
    {
        $this->fieldName = $fieldName;
        $this->order = $order;
    }

    /**
     * @param Builder $queryBuilder
     */
    public function modify(Builder $queryBuilder): void
    {
        $queryBuilder->sort($this->fieldName, $this->order);
    }
}
