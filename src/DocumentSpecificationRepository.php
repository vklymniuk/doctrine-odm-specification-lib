<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\MongoDB\Iterator;
use Doctrine\ODM\MongoDB\Query\Builder;
use Doctrine\ODM\MongoDB\Query\Query;
use Doctrine\ODM\MongoDB\Specification\ResultModifier\ResultModifierInterface;
use Doctrine\ODM\MongoDB\Specification\ResultTransformer\ResultTransformerInterface;
use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Class SpecificationDocumentRepository
 */
class DocumentSpecificationRepository extends DocumentRepository implements DocumentSpecificationRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function match(
        MatchSpecificationInterface $specification,
        ResultTransformerInterface $resultTransformer = null,
        ResultModifierInterface $resultModifier = null
    ): LazySpecificationCollection {
        return new LazySpecificationCollection($this, $specification, $resultModifier, $resultTransformer);
    }

    /**
     * @inheritdoc
     */
    public function matchSingleResult(
        MatchSpecificationInterface $specification,
        ResultTransformerInterface $transformer = null,
        ResultModifierInterface $modifier = null
    ) {
        $result = $this->getQuery($specification, $modifier)->getSingleResult();

        if ($transformer instanceof ResultTransformerInterface) {
            $result = $transformer->transform($result);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function matchOneOrNullResult(
        MatchSpecificationInterface $specification,
        ResultTransformerInterface $transformer = null,
        ResultModifierInterface $modifier = null
    ) {
        try {
            return $this->matchSingleResult($specification, $transformer, $modifier);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function getQuery(MatchSpecificationInterface $specification, ResultModifierInterface $modifier = null): Query
    {
        $queryBuilder = $this->getQueryBuilder($specification);

        if ($modifier !== null) {
            $modifier->modify($queryBuilder);
        }

        return $queryBuilder->getQuery();
    }

    /**
     * @inheritdoc
     */
    public function getQueryBuilder(MatchSpecificationInterface $specification): Builder
    {
        $queryBuilder = $this->createQueryBuilder();

        //apply specification to the query builder
        SpecificationApplier::apply(clone $specification, $queryBuilder);

        return $queryBuilder;
    }

    /**
     * @inheritdoc
     */
    public function aggregate(AggregateSpecificationInterface $specification): Iterator
    {
        $queryBuilder = $this->createAggregationBuilder();

        return $specification->aggregate($queryBuilder);
    }

}
