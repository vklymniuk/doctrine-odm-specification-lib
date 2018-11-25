<?php

namespace Doctrine\ODM\MongoDB\Specification\Manager;

use Doctrine\MongoDB\Iterator;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Specification\AggregateSpecificationInterface;
use Doctrine\ODM\MongoDB\Specification\DocumentSpecificationRepositoryInterface;
use Doctrine\ODM\MongoDB\Specification\LazySpecificationCollection;
use Doctrine\ODM\MongoDB\Specification\ResultTransformer\ResultTransformerInterface;
use Doctrine\ODM\MongoDB\Specification\MatchSpecificationInterface;

/**
 * Class AbstractManager
 */
abstract class AbstractManager implements ManagerInterface
{
    /**
     * @var DocumentManager
     */
    protected $dm;

    /**
     * PaymentsManager constructor.
     *
     * @param DocumentManager $dm
     */
    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function supports(): string;

    /**
     * {@inheritdoc}
     */
    public function find(
        MatchSpecificationInterface $specification,
        ResultTransformerInterface $resultTransformer = null
    ): LazySpecificationCollection {
        return $this->getRepository()->match($specification, $resultTransformer);
    }

    /**
     * {@inheritdoc}
     */
    public function findOne(MatchSpecificationInterface $specification): ?object
    {
        return $this->getRepository()->matchOneOrNullResult($specification);
    }

    /**
     * @param AggregateSpecificationInterface $specification
     *
     * @return Iterator
     */
    public function aggregate(AggregateSpecificationInterface $specification): Iterator
    {
        return $this->getRepository()->aggregate($specification);
    }

    /**
     * @return DocumentSpecificationRepositoryInterface
     */
    abstract protected function getRepository(): DocumentSpecificationRepositoryInterface;
}
