<?php

namespace Doctrine\ODM\MongoDB\Specification\Expr;

use Doctrine\ODM\MongoDB\Specification\MongoDictionary;

/**
 * Class Exists
 */
class Exists extends Comparison
{
    /**
     * NotEqual constructor.
     *
     * @param string $field
     * @param mixed  $value
     */
    public function __construct(string $field, $value)
    {
        parent::__construct(MongoDictionary::EXPRESSIONS_EXISTS, $field, $value);
    }
}
