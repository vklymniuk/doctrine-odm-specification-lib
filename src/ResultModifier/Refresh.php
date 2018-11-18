<?php

namespace Doctrine\ODM\MongoDB\Specification\ResultModifier;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Class Refresh
 */
class Refresh implements ResultModifierInterface
{
    /**
     * @var bool
     */
    private $refresh;

    /**
     * Refresh constructor.
     *
     * @param bool $refresh
     */
    public function __construct(bool $refresh = true)
    {
        $this->refresh = $refresh;
    }

    /**
     * @param Builder $query
     */
    public function modify(Builder $query): void
    {
        $query->refresh($this->refresh);
    }
}
