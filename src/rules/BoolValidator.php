<?php

namespace libs\Validate\rules;

use libs\Validate\LValidator;
use libs\Validate\Rule;

/**
 * Class BoolValidator
 * @author chenqionghe
 * @package libs\Validate\rules
 */
class BoolValidator implements Rule
{
    /**
     * @return string
     */
    public static function message()
    {
        return '{field}必须是布尔值';
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
        return is_bool($value);
    }

}
