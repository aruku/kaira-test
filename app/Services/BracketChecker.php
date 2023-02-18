<?php

namespace App\Services;

class BracketChecker {
    private array $stack = [];

    private const pairs = [
        '{' => '}',
        '[' => ']',
        '(' => ')',
    ];

    public function check(string $string): bool
    {
        if (preg_match("~[^()\[\]{}]+~", $string) || empty($string)) {
            return false;
        }

        foreach (str_split($string) as $char) {
            if (in_array($char, array_keys($this::pairs))) {
                $this->stack[] = $char;
            } elseif (in_array($char, $this::pairs)) {
                if ($this->stack[array_key_last($this->stack)] != array_search($char, $this::pairs)) {
                    return false;
                }
                array_pop($this->stack);
            }
        }

        if (empty($this->stack)) {
            return true;
        }

        return false;
    }
}
