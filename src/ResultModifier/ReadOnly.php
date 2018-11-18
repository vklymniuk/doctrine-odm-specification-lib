<?php

namespace Doctrine\ODM\MongoDB\Specification\ResultModifier;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Whether or not to register documents in UnitOfWork.
 *
 * Class ReadOnly
 */
class ReadOnly implements ResultModifierInterface
{
    /**
     * @var bool
     */
    private $readOnly;

    /**
     * ReadOnly constructor.
     *
     * @param bool $readOnly
     */
    public function __construct(bool $readOnly = true)
    {
        $this->readOnly = $readOnly;
    }

    /**
     * @inheritdoc
     */
    public function modify(Builder $query): void
    {
        $query->readOnly($this->readOnly);
    }
}
