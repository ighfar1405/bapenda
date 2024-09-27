<?php
if (!function_exists('setDefaultArrayValue')) {

    #   set the default value of the array key

    function setDefaultArrayValue(array $arrayKey, array $array)
    {
        $params = $arrayKey;

        foreach ($params as $value) {
            if (!array_key_exists($value, $array)) {
                $array[$value] = null;
            }
        }

        return $array;
    }
}
