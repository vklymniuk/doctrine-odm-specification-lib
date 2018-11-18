<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\MongoDB\Iterator;

/**
 * Interface SpecificationMatchInterface
 */
interface SpecificationMatchInterface
{
    /**
     * @param SpecificationInterface $specification
     *
     * @return null|Object
     */
    public function matchOne(SpecificationInterface $specification): ?Object;

    /**
     * @param SpecificationInterface $specification
     *
     * @return Iterator
     */
    public function match(SpecificationInterface $specification): Iterator;
}
