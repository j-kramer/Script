<?php

class Validator {
    public function string(string $value, int $min = 1, int $max = PHP_INT_MAX): bool {
        $length = mb_strlen($value);
        return $min <= $length && $length <= $max;
    }

    public function integer(int $value, int $min): bool {
        return $value >= $min;
    }

    public function decimal(float $value, float $min, float $max): bool {
        return $min <= $value && $value <= $max;
    }
}