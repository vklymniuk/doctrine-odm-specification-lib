<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\MongoDB\Iterator;

/**
 * Interface SpecificationMatchInterface
 */
interface SpecificationMatchInterface
{
    /**
     * @param MatchSpecificationInterface $specification
     *
     * @return null|Object
     */
    public function matchOne(MatchSpecificationInterface $specification): ?Object;

    /**
     * @param MatchSpecificationInterface $specification
     *
     * @return Iterator
     */
    public function match(MatchSpecificationInterface $specification): Iterator;
}
