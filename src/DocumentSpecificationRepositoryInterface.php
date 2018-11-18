<?php

namespace Doctrine\ODM\MongoDB\Specification;

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
     * @param SpecificationInterface     $specification
     * @param ResultTransformerInterface $resultTransformer
     * @param ResultModifierInterface    $resultModifier
     *
     * @return LazySpecificationCollection
     */
    public function match(
        SpecificationInterface $specification,
        ResultTransformerInterface $resultTransformer = null,
        ResultModifierInterface $resultModifier = null
    ): LazySpecificationCollection;

    /**
     * Get single result when you match with a Specification.
     *
     * @param SpecificationInterface     $specification
     * @param ResultTransformerInterface $transformer
     * @param ResultModifierInterface    $modifier
     *
     * @throw \NonUniqueException  If more than one result is found
     * @throw \NoResultException   If no results found
     *
     * @return mixed
     */
    public function matchSingleResult(
        SpecificationInterface $specification,
        ResultTransformerInterface $transformer = null,
        ResultModifierInterface $modifier = null
    );

    /**
     * Get single result or null when you match with a Specification.
     *
     * @param SpecificationInterface     $specification
     * @param ResultTransformerInterface $transformer
     * @param ResultModifierInterface    $modifier
     *
     * @throw Exception\NonUniqueException  If more than one result is found
     *
     * @return mixed|null
     */
    public function matchOneOrNullResult(
        SpecificationInterface $specification,
        ResultTransformerInterface $transformer = null,
        ResultModifierInterface $modifier = null
    );

    /**
     * Get doctrine query for execution
     *
     * @param SpecificationInterface       $specification
     * @param ResultModifierInterface|null $modifier
     *
     * @return Query
     */
    public function getQuery(SpecificationInterface $specification, ResultModifierInterface $modifier = null): Query;

    /**
     * Get query builder with applied specification
     *
     * @param SpecificationInterface $specification
     *
     * @return Builder
     */
    public function getQueryBuilder(SpecificationInterface $specification): Builder;
}
