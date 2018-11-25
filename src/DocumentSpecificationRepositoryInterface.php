<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\MongoDB\Iterator;
use Doctrine\ODM\MongoDB\Query\Builder;
use Doctrine\ODM\MongoDB\Query\Query;
use Doctrine\ODM\MongoDB\Specification\ResultModifier\ResultModifierInterface;
use Doctrine\ODM\MongoDB\Specification\ResultTransformer\ResultTransformerInterface;

/**
 * Interface SpecificationDocumentRepositoryInterface
 */
interface DocumentSpecificationRepositoryInterface
{
    /**
     * Get results when you match with a Specification.
     *
     * @param MatchSpecificationInterface     $specification
     * @param ResultTransformerInterface $resultTransformer
     * @param ResultModifierInterface    $resultModifier
     *
     * @return LazySpecificationCollection
     */
    public function match(
        MatchSpecificationInterface $specification,
        ResultTransformerInterface $resultTransformer = null,
        ResultModifierInterface $resultModifier = null
    ): LazySpecificationCollection;

    /**
     * Get single result when you match with a Specification.
     *
     * @param MatchSpecificationInterface     $specification
     * @param ResultTransformerInterface $transformer
     * @param ResultModifierInterface    $modifier
     *
     * @throw \NonUniqueException  If more than one result is found
     * @throw \NoResultException   If no results found
     *
     * @return mixed
     */
    public function matchSingleResult(
        MatchSpecificationInterface $specification,
        ResultTransformerInterface $transformer = null,
        ResultModifierInterface $modifier = null
    );

    /**
     * Get single result or null when you match with a Specification.
     *
     * @param MatchSpecificationInterface     $specification
     * @param ResultTransformerInterface $transformer
     * @param ResultModifierInterface    $modifier
     *
     * @throw Exception\NonUniqueException  If more than one result is found
     *
     * @return mixed|null
     */
    public function matchOneOrNullResult(
        MatchSpecificationInterface $specification,
        ResultTransformerInterface $transformer = null,
        ResultModifierInterface $modifier = null
    );

    /**
     * Get doctrine query for execution
     *
     * @param MatchSpecificationInterface       $specification
     * @param ResultModifierInterface|null $modifier
     *
     * @return Query
     */
    public function getQuery(MatchSpecificationInterface $specification, ResultModifierInterface $modifier = null): Query;

    /**
     * Get query builder with applied specification
     *
     * @param AggregateSpecificationInterface $specification
     *
     * @return Iterator
     */
    public function aggregate(AggregateSpecificationInterface $specification): Iterator;

    /**
     * Get query builder with applied specification
     *
     * @param MatchSpecificationInterface $specification
     *
     * @return Builder
     */
    public function getQueryBuilder(MatchSpecificationInterface $specification): Builder;
}
