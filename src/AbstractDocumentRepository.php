<?php

namespace Doctrine\ODM\MongoDB\Specification;

use Doctrine\MongoDB\CursorInterface;
use Doctrine\MongoDB\Iterator;
use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Class AbstractDocumentRepository
 */
abstract class AbstractDocumentRepository extends DocumentRepository implements SpecificationMatchInterface
{
    /**
     * @inheritdoc
     */
    public function matchOne(SpecificationInterface $specification): ?Object
    {
        if ($specification->supports() !== $this->getDocumentName()) {
            throw new \InvalidArgumentException(\sprintf(
                'Specification %s not supported by this repository.',
                \get_class($specification)
            ));
        }

        return $this->fetchQuery($specification)->getSingleResult();
    }

    /**
     * @inheritdoc
     */
    public function match(SpecificationInterface $specification): Iterator
    {
        if ($specification->supports() !== $this->getDocumentName()) {
            throw new \InvalidArgumentException(\sprintf(
        'Specification %s not supported by this repository.',
                \get_class($specification)
            ));
        }

        return $this->fetchQuery($specification);
    }

    /**
     * @param SpecificationInterface $specification
     *
     * @return CursorInterface
     *
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    protected function fetchQuery(SpecificationInterface $specification): CursorInterface
    {
        $qb = $this->createQueryBuilder();
        SpecificationApplier::apply(clone $specification, $qb);

        return $qb->getQuery()->execute();
    }
}
