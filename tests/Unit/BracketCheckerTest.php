<?php

namespace Tests\Unit;

use App\Services\BracketChecker;
use PHPUnit\Framework\TestCase;

class BracketCheckerTest extends TestCase
{
    /**
     * @dataProvider provideBracketStrings
     */
    public function test_it_checks_bracket_strings($expectedResult, $string): void
    {
        $checker = new BracketChecker();

        $this->assertSame($expectedResult, $checker->check($string));
    }

    public static function provideBracketStrings(): array
    {
        return [
          [true, '()'],
          [true, '([{}])'],
          [false, 'a'],
          [false, '([{a}])'],
          [false, '([{]})'],
          [false, ''],
          [false, '}{'],
        ];
    }
}
