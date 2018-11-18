<?php

namespace Doctrine\ODM\MongoDB\Specification\Expr;

use Doctrine\ODM\MongoDB\Specification\MongoDictionary;

/**
 * Class LessThan
 */
class LessThan extends Comparison
{
    /**
     * NotEqual constructor.
     *
     * @param string $field
     * @param mixed  $value
     */
    public function __construct(string $field, $value)
    {
        parent::__construct(MongoDictionary::COMPARISON_LOWER, $field, $value);
    }
}

