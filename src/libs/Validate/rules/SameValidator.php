<?php

namespace libs\Validate\rules;

use libs\Validate\LValidator;
use libs\Validate\Rule;

/**
 * Class SameValidator
 * @author chenqionghe
 * @package libs\Validate\rules
 */
class SameValidator implements Rule
{
    /**
     * @return string
     */
    public static function message()
    {
        return "{field}必须和%s相同";
    }

    /**
     * @param $field
     * @param $value
     * @param array $params
     * @param LValidator $validator
     * @return bool
     */
    public static function validate($field, $value, $params = [], LValidator $validator)
    {
        $field2 = $params[0];
        return $value == $validator->$field2;
    }
}
