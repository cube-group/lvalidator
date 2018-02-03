<?php

namespace libs\Validate\rules;

use libs\Validate\LValidator;
use libs\Validate\Rule;

/**
 * Class MobileValidator
 * @author chenqionghe
 * @package libs\Validate\rules
 */
class MobileValidator implements Rule
{
    /**
     * @return string
     */
    public static function message()
    {
        return "{field}不是有效的手机号码";
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
        return preg_match('/^(\+?86-?|0)?1[0-9]{10}$/', $value);
    }
}
