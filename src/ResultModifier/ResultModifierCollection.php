<?php

namespace Doctrine\ODM\MongoDB\Specification\ResultModifier;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Class ResultModifierCollection
 */
class ResultModifierCollection implements ResultModifierInterface
{
    /**
     * @var ResultModifierInterface[]
     */
    private $resultModifiers;

    /**
     * Construct it with one or more instances of ResultModifier.
     */
    public function __construct()
    {
        $this->resultModifiers = \func_get_args();
    }

    /**
     * {@inheritdoc}
     */
    public function modify(Builder $query): void
    {
        foreach ($this->resultModifiers as $child) {
            if (!$child instanceof ResultModifierInterface) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Child passed to ResultModifierCollection must be an instance of ResultModifierInterface, but instance of %s found',
                        \get_class($child)
                    )
                );
            }

            $child->modify($query);
        }
    }
}
