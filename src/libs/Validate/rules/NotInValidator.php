<?php

namespace libs\Validate\rules;

use libs\Validate\LValidator;
use libs\Validate\Rule;

/**
 * Class NotInValidator
 * @author chenqionghe
 * @package libs\Validate\rules
 */
class NotInValidator implements Rule
{
    /**
     * @return string
     */
    public static function message()
    {
        return "{field}不能在范围%s, 非法值{value}";
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
        return !InValidator::validate($field, $value, $params, $validator);
    }

}
