<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Class SpecificationApplier
 */
class SpecificationApplier
{
    /**
     * @param MatchSpecificationInterface $specification
     * @param Builder                     $queryBuilder
     */
    public static function apply(MatchSpecificationInterface $specification, Builder $queryBuilder): void
    {
        //expressions
        if ($where = $specification->getExpression()) {
            $queryBuilder->setQueryArray($where->getQuery());
        }

        //query modifiers
        $modifiers = $specification->getQueryModifiers();
        foreach ($modifiers as $modifier) {
            $modifier->modify($queryBuilder);
        }
    }
}
