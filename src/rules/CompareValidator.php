<?php

namespace libs\Validate\rules;

use libs\Validate\LValidator;
use libs\Validate\Rule;

/**
 * Class CompareValidator
 * @author chenqionghe
 * @package libs\Validate\rules
 */
class CompareValidator implements Rule
{
    /**
     * @return string
     */
    public static function message()
    {
        return "{field}必须%s%s";
    }

    /**
     * @param $field
     * @param $value
     * @param array $params
     * @param LValidator $validator
     * @return mixed
     */
    public static function validate($field, $value, $params = [], LValidator $validator)
    {
        $operator = $params[0];
        $compareValue = $params[1];
        switch ($operator) {
            case '==':
                return $value == $compareValue;
            case '===':
                return $value === $compareValue;
            case '!=':
                return $value != $compareValue;
            case '!==':
                return $value !== $compareValue;
            case '>':
                return $value > $compareValue;
            case '>=':
                return $value >= $compareValue;
            case '<':
                return $value < $compareValue;
            case '<=':
                return $value <= $compareValue;
            default:
                return false;
        }
    }
}
