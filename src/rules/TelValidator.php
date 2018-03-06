<?php

namespace libs\Validate\rules;

use libs\Validate\LValidator;
use libs\Validate\Rule;

/**
 * Class TelValidator
 * @author chenqionghe
 * @package libs\Validate\rules
 */
class TelValidator implements Rule
{
    /**
     * @return string
     */
    public static function message()
    {
        return "{field}不是有效的大陆电话";
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
        return preg_match('/(\d{4}-|\d{3}-)?(\d{8}|\d{7})/', $value);
    }

}
