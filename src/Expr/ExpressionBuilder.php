<?php

namespace Doctrine\ODM\MongoDB\Specification\Expr;

use Doctrine\ODM\MongoDB\Specification\MongoDictionary;

/**
 * Class ExpressionBuilder
 */
class ExpressionBuilder
{
    /**
     * @return CompositeExpression
     */
    public function andX(): CompositeExpression
    {
        return new CompositeExpression(CompositeExpression::TYPE_AND, \func_get_args());
    }

    /**
     * @return CompositeExpression
     */
    public function orX(): CompositeExpression
    {
        return new CompositeExpression(CompositeExpression::TYPE_OR, \func_get_args());
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionInterface
     */
    public function gt(string $field, $value): ExpressionInterface
    {
        return new Comparison(MongoDictionary::COMPARISON_GREATER, $field, $value);
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionInterface
     */
    public function gte(string $field, $value): ExpressionInterface
    {
        return new Comparison(MongoDictionary::COMPARISON_GREATER_OR_EQUAL, $field, $value);
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionInterface
     */
    public function lt(string $field, $value): ExpressionInterface
    {
        return new Comparison(MongoDictionary::COMPARISON_LOWER, $field, $value);
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionInterface
     */
    public function lte(string $field, $value): ExpressionInterface
    {
        return new Comparison(MongoDictionary::COMPARISON_LOWER_OR_EQUAL, $field, $value);
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionInterface
     */
    public function elemMatch(string $field, $value): ExpressionInterface
    {
        return new Comparison(MongoDictionary::COMPARISON_ELEMENT_MATCH, $field, $value);
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionInterface
     */
    public function equals(string $field, $value): ExpressionInterface
    {
        return new Comparison(MongoDictionary::COMPARISON_EQUALS, $field, $value);
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionInterface
     */
    public function notEqual(string $field, $value): ExpressionInterface
    {
        return new Comparison(MongoDictionary::COMPARISON_NOT_EQUAL, $field, $value);
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionInterface
     */
    public function exists(string $field, $value): ExpressionInterface
    {
        return new Comparison(MongoDictionary::EXPRESSIONS_EXISTS, $field, $value);
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionInterface
     */
    public function in(string $field, array $value): ExpressionInterface
    {
        return new Comparison(MongoDictionary::COMPARISON_IN, $field, $value);
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionInterface
     */
    public function notIn(string $field, array $value): ExpressionInterface
    {
        return new Comparison(MongoDictionary::COMPARISON_NOT_IN, $field, $value);
    }
}
