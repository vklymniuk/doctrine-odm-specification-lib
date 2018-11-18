<?php

namespace Doctrine\ODM\MongoDB\Specification\Manager;

use Doctrine\ODM\MongoDB\Specification\LazySpecificationCollection;
use Doctrine\ODM\MongoDB\Specification\ResultTransformer\ResultTransformerInterface;
use Doctrine\ODM\MongoDB\Specification\SpecificationInterface;

/**
 * Interface ManagerInterface
 */
interface ManagerInterface
{
    /**
     * @param SpecificationInterface          $specification
     * @param ResultTransformerInterface|null $resultTransformer
     *
     * @return LazySpecificationCollection
     */
    public function find(
        SpecificationInterface $specification,
        ResultTransformerInterface $resultTransformer = null
    ): LazySpecificationCollection;

    /**
     * @param SpecificationInterface $specification
     *
     * @return object|null
     */
    public function findOne(SpecificationInterface $specification): ?object;

    /**
     * Returns Entity class which manager works
     *
     * @return string
     */
    public function supports(): string;
}
