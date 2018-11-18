<?php

namespace Doctrine\ODM\MongoDB\Specification\Expr;

use Doctrine\ODM\MongoDB\Query\Builder;
use Doctrine\ODM\MongoDB\Query\Expr;
use Doctrine\ODM\MongoDB\Specification\MongoDictionary;

/**
 * Class Comparison
 */
class Comparison implements ExpressionInterface
{
    /**
     * @var array
     */
    private static $operators = [
        MongoDictionary::COMPARISON_EQUALS,
        MongoDictionary::COMPARISON_GREATER,
        MongoDictionary::COMPARISON_GREATER_OR_EQUAL,
        MongoDictionary::COMPARISON_LOWER,
        MongoDictionary::COMPARISON_LOWER,
        MongoDictionary::COMPARISON_LOWER_OR_EQUAL,
        MongoDictionary::COMPARISON_NOT_EQUAL,
        MongoDictionary::COMPARISON_IN,
        MongoDictionary::COMPARISON_NOT_IN,
        MongoDictionary::COMPARISON_ELEMENT_MATCH,
        MongoDictionary::EXPRESSIONS_EXISTS,
    ];

    /**
     * @var string field
     */
    protected $field;

    /**
     * @var string value
     */
    protected $value;

    /**
     * @var string
     */
    private $operator;

    /**
     * Make sure the $field has a value equals to $value.
     *
     * @param string $operator
     * @param string $field
     * @param mixed  $value
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $operator, string $field, $value)
    {
        if (!\in_array($operator, self::$operators, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid comparison operator. Valid operators are: "%s"',
                    $operator,
                    implode(', ', self::$operators)
                )
            );
        }

        $this->operator = $operator;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @param Builder $queryBuilder
     *
     * @return Expr
     */
    public function getExpr(Builder $queryBuilder): Expr
    {
        return $queryBuilder->expr()->field($this->field)->operator($this->operator, $this->value);
    }
}
