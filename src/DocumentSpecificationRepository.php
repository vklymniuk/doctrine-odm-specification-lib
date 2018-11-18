<?php

namespace Doctrine\ODM\MongoDB\Specification;

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
    ): LazySpecificationCollection {
        return new LazySpecificationCollection($this, $specification, $resultModifier, $resultTransformer);
    }

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
    ) {
        $result = $this->getQuery($specification, $modifier)->getSingleResult();

        if ($transformer instanceof ResultTransformerInterface) {
            $result = $transformer->transform($result);
        }

        return $result;
    }

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
    ) {
        try {
            return $this->matchSingleResult($specification, $transformer, $modifier);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get doctrine query for execution
     *
     * @param SpecificationInterface       $specification
     * @param ResultModifierInterface|null $modifier
     *
     * @return Query
     */
    public function getQuery(SpecificationInterface $specification, ResultModifierInterface $modifier = null): Query
    {
        $queryBuilder = $this->getQueryBuilder($specification);

        if ($modifier !== null) {
            $modifier->modify($queryBuilder);
        }

        return $queryBuilder->getQuery();
    }

    /**
     * Get query builder with applied specification
     *
     * @param SpecificationInterface $specification
     *
     * @return Builder
     */
    public function getQueryBuilder(SpecificationInterface $specification): Builder
    {
        $queryBuilder = $this->createQueryBuilder();

        //apply specification to the query builder
        SpecificationApplier::apply(clone $specification, $queryBuilder);

        return $queryBuilder;
    }


    /**
     * @param SpecificationInterface $specification
     */
    private function supports(SpecificationInterface $specification): void
    {
        if ($specification->supports() !== $this->getDocumentName()) {
            throw new \InvalidArgumentException(\sprintf(
                'Specification %s not supported by this repository.',
                \get_class($specification)
                ));
        }
    }
}
