<?php

namespace libs\Validate\rules;

use libs\Validate\LValidator;
use libs\Validate\Rule;

/**
 * Class LengthValidator
 * @author chenqionghe
 * @package libs\Validate\rules
 */
class LengthValidator implements Rule
{
    /**
     * @return string
     */
    public static function message()
    {
        return "{field}长度必须%s%s";
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
        return CompareValidator::validate($field, mb_strlen($value), $params, $validator);
    }
}
