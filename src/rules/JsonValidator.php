<?php

namespace libs\Validate\rules;

use libs\Validate\LValidator;
use libs\Validate\Rule;

/**
 * Class JsonValidator
 * @author chenqionghe
 * @package libs\Validate\rules
 */
class JsonValidator implements Rule
{
    /**
     * @return string
     */
    public static function message()
    {
        return "{field}不是合法的json结构";
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
        return is_array(json_decode($value, true));
    }

}
