<?php

namespace Framework;

class Validation{

    public static function string($value, $min = 1, $max = 200){
        if(is_string($value)){
            $value = trim($value);
            $length = strlen($value);
            return $length >= $min && $length <= $max;
        }
        return false;
    }

    public static function email($email){
        $email = trim($email);
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function match($value1, $value2){
        $value1 = trim($value1);
        $value2 = trim($value2);

        return $value1 === $value2;
    }
}