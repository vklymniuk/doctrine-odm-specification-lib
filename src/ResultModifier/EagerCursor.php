<?php

namespace Doctrine\ODM\MongoDB\Specification\ResultModifier;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Class EagerCursor
 */
class EagerCursor implements ResultModifierInterface
{
    /**
     * @var bool
     */
    private $eagerCursor;

    /**
     * EagerCursor constructor.
     *
     * @param bool $eagerCursor
     */
    public function __construct(bool $eagerCursor = true)
    {
        $this->eagerCursor = $eagerCursor;
    }

    /**
     * @param Builder $query
     */
    public function modify(Builder $query): void
    {
        $query->eagerCursor($this->eagerCursor);
    }
}
