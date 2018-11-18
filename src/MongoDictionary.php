<?php

namespace Doctrine\ODM\MongoDB\Specification;

/**
 * Class MongoDictionary
 */
final class MongoDictionary
{
    // Stage Operators
    public const STAGE_PROJECT  = '$project';
    public const STAGE_MATCH    = '$match';
    public const STAGE_REDACT   = '$redact';
    public const STAGE_LIMIT    = '$limit';
    public const STAGE_SKIP     = '$skip';
    public const STAGE_UNWIND   = '$unwind';
    public const STAGE_GROUP    = '$group';
    public const STAGE_SORT     = '$sort';
    public const STAGE_OUT      = '$out';
    public const STAGE_GEO_NEAR = '$geoNear';

    // Boolean Operators
    public const BOOLEAN_AND = '$and';
    public const BOOLEAN_OR  = '$or';
    public const BOOLEAN_NOT = '$not';

    //Comparison Operators
    public const COMPARISON_EQUALS           = '$eq';
    public const COMPARISON_GREATER          = '$gt';
    public const COMPARISON_GREATER_OR_EQUAL = '$gte';
    public const COMPARISON_LOWER            = '$lt';
    public const COMPARISON_LOWER_OR_EQUAL   = '$lte';
    public const COMPARISON_NOT_EQUAL        = '$ne';
    public const COMPARISON_IN               = '$in';
    public const COMPARISON_NOT_IN           = '$nin';
    public const COMPARISON_ELEMENT_MATCH    = '$elemMatch';

    // Arithmetic Operators
    public const ARITHMETIC_ADD      = '$add';
    public const ARITHMETIC_SUBTRACT = '$subtract';
    public const ARITHMETIC_MULTIPLY = '$multiply';
    public const ARITHMETIC_DIVIDE   = '$divide';
    public const ARITHMETIC_MOD      = '$mod';

    //Date Operators
    public const DATE_DAY_OF_YEAR    = '$dayOfYear';
    public const DATE_DAY_OF_MONTH   = '$dayOfMonth';
    public const DATE_DAY_OF_WEEK    = '$dayOfWeek';
    public const DATE_YEAR           = '$year';
    public const DATE_MONTH          = '$month';
    public const DATE_WEEK           = '$week';
    public const DATE_HOUR           = '$hour';
    public const DATE_MINUTE         = '$minute';
    public const DATE_SECOND         = '$second';
    public const DATE_DATE_TO_STRING = '$dateToString';

    // Conditional Expressions
    public const EXPRESSIONS_COND    = '$cond';
    public const EXPRESSIONS_IF_NULL = '$ifNull';
    public const EXPRESSIONS_EXISTS  = '$exists';

    // Accumulators
    public const ACCUMULATORS_SUM        = '$sum';
    public const ACCUMULATORS_ABG        = '$avg';
    public const ACCUMULATORS_FIRST      = '$first';
    public const ACCUMULATORS_LAST       = '$last';
    public const ACCUMULATORS_MAX        = '$max';
    public const ACCUMULATORS_MIN        = '$min';
    public const ACCUMULATORS_PUSH       = '$push';
    public const ACCUMULATORS_ADD_TO_SET = '$addToSet';

    // Set Operators
    public const SET_IS_SUBSET = '$setIsSubset';
}
