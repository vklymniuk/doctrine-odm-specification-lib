<?php

namespace Doctrine\ODM\MongoDB\Specification\Manager;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Specification\DocumentSpecificationRepositoryInterface;
use Doctrine\ODM\MongoDB\Specification\LazySpecificationCollection;
use Doctrine\ODM\MongoDB\Specification\ResultTransformer\ResultTransformerInterface;
use Doctrine\ODM\MongoDB\Specification\SpecificationInterface;

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
        SpecificationInterface $specification,
        ResultTransformerInterface $resultTransformer = null
    ): LazySpecificationCollection {
        return $this->getRepository()->match($specification, $resultTransformer);
    }

    /**
     * {@inheritdoc}
     */
    public function findOne(SpecificationInterface $specification): ?object
    {
        return $this->getRepository()->matchOneOrNullResult($specification);
    }

    /**
     * @return DocumentSpecificationRepositoryInterface
     */
    abstract protected function getRepository(): DocumentSpecificationRepositoryInterface;
}
