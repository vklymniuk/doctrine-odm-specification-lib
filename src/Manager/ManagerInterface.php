<?php

namespace Doctrine\ODM\MongoDB\Specification\Manager;

use Doctrine\MongoDB\Iterator;
use Doctrine\ODM\MongoDB\Specification\AggregateSpecificationInterface;
use Doctrine\ODM\MongoDB\Specification\LazySpecificationCollection;
use Doctrine\ODM\MongoDB\Specification\ResultTransformer\ResultTransformerInterface;
use Doctrine\ODM\MongoDB\Specification\MatchSpecificationInterface;

/**
 * Interface ManagerInterface
 */
interface ManagerInterface
{
    /**
     * @param MatchSpecificationInterface          $specification
     * @param ResultTransformerInterface|null $resultTransformer
     *
     * @return LazySpecificationCollection
     */
    public function find(
        MatchSpecificationInterface $specification,
        ResultTransformerInterface $resultTransformer = null
    ): LazySpecificationCollection;

    /**
     * @param MatchSpecificationInterface $specification
     *
     * @return object|null
     */
    public function findOne(MatchSpecificationInterface $specification): ?object;

    /**
     * @param AggregateSpecificationInterface $specification
     *
     * @return Iterator
     */
    public function aggregate(AggregateSpecificationInterface $specification): Iterator;

    /**
     * Returns Entity class which manager works
     *
     * @return string
     */
    public function supports(): string;
}
