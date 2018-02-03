<?php

namespace libs\Validate\rules;

use libs\Validate\LValidator;
use libs\Validate\Rule;

/**
 * Class RegexValidator
 * @author chenqionghe
 * @package libs\Validate\rules
 */
class RegexValidator implements Rule
{
    /**
     * @return string
     */
    public static function message()
    {
        return "{field}格式无效";
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
        return preg_match($params[0], $value);
    }

}
