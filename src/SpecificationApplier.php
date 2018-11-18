<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Class SpecificationApplier
 */
class SpecificationApplier
{
    /**
     * @param SpecificationInterface $specification
     * @param Builder                $queryBuilder
     */
    public static function apply(SpecificationInterface $specification, Builder $queryBuilder): void
    {
        //expressions
        if ($where = $specification->getWhereExpression()) {
            $queryBuilder->setQueryArray($where->getExpr($queryBuilder)->getQuery());
        }

        //query modifiers
        $modifiers = $specification->getQueryModifiers();
        foreach ($modifiers as $modifier) {
            $modifier->modify($queryBuilder);
        }
    }
}
