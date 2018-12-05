<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Query\Builder;
use Doctrine\Common\Collections\AbstractLazyCollection;
use Doctrine\ODM\MongoDB\Specification\QueryModifier\QueryModifierInterface;
use Doctrine\ODM\MongoDB\Specification\ResultModifier\ResultModifierInterface;
use Doctrine\ODM\MongoDB\Specification\ResultTransformer\ResultTransformerInterface;

/**
 * Class LazySpecificationCollection
 */
class LazySpecificationCollection extends AbstractLazyCollection
{
    /**
     * @var DocumentSpecificationRepository
     */
    private $repository;

    /**
     * @var MatchSpecificationInterface
     */
    private $specification;

    /**
     * @var QueryModifierInterface
     */
    private $resultModifier;

    /**
     * @var ResultTransformerInterface
     */
    private $resultTransformer;

    /**
     * @TODO: Remove it
     *
     * @var int
     */
    private $count;

    /**
     * LazySpecificationCollection constructor.
     *
     * @param DocumentSpecificationRepository $repository
     * @param MatchSpecificationInterface     $specification
     * @param ResultModifierInterface|null    $resultModifier
     * @param ResultTransformerInterface|null $resultTransformer
     */
    public function __construct(
        DocumentSpecificationRepository $repository,
        MatchSpecificationInterface $specification,
        ResultModifierInterface $resultModifier = null,
        ResultTransformerInterface $resultTransformer = null
    ) {
        $this->repository = $repository;
        $this->specification = $specification;
        $this->resultModifier = $resultModifier;
        $this->resultTransformer = $resultTransformer;
    }

    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return $this->repository->getQueryBuilder($this->specification);
    }

    /**
     * @return DocumentSpecificationRepository
     */
    public function getRepository(): DocumentSpecificationRepository
    {
        return $this->repository;
    }

    /**
     * @return MatchSpecificationInterface
     */
    public function getSpecification(): MatchSpecificationInterface
    {
        return $this->specification;
    }

    /**
     * @return QueryModifierInterface
     */
    public function getResultModifier(): QueryModifierInterface
    {
        return $this->resultModifier;
    }

    /**
     * @return ResultTransformerInterface
     */
    public function getResultTransformer(): ?ResultTransformerInterface
    {
        return $this->resultTransformer;
    }

    /**
     * @param ResultTransformerInterface $resultTransformer
     *
     * @return LazySpecificationCollection
     */
    public function setResultTransformer($resultTransformer): self
    {
        $this->resultTransformer = $resultTransformer;

        return $this;
    }

    /**
     * @TODO: Remove after release
     *
     * {@inheritDoc}
     */
    public function count()
    {
        $this->initialize();

        return $this->count;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        $query = $this->repository->getQuery($this->specification);

        return $query->count();
    }

    /**
     * {@inheritDoc}
     */
    protected function doInitialize(): void
    {
        $query = $this->repository->getQuery($this->specification, $this->resultModifier);
        $this->count = $query->count();

        $result = $query->execute();

        if ($this->resultTransformer instanceof ResultTransformerInterface) {
            $result = $this->resultTransformer->transform($result);
        }

        $collection = new ArrayCollection();
        foreach ($result as $item) {
            $collection[] = $item;
        }

        $this->collection = $collection;
    }
}
