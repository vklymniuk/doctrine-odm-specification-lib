<?php

namespace Doctrine\ODM\MongoDB\Specification\ResultTransformer;

/**
 * Interface ResultTransformerInterface
 */
interface ResultTransformerInterface
{
    /**
     * @param array|mixed $result
     */
    public function transform($result);
}
