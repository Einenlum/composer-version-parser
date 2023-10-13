<?php

declare(strict_types=1);

namespace Einenlum\Tests\ComposerVersionParser;

use Einenlum\ComposerVersionParser\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    private Parser $sut;

    public function setUp(): void
    {
        $this->sut = new Parser();
    }

    /** 
     * @test 
     * @dataProvider data
     */
    public function it_parses_a_version(string $input, ?string $expected): void
    {
        $this->assertEquals($expected, $this->sut->parse($input));
    }

    public static function data(): array
    {
        return [
            'v1.0.*' => ['v1.0.*', '1.0'],
            '1.0.*' => ['1.0.*', '1.0'],
            '^3.*' => ['^3.*', '3'],
            '^3.4.*' => ['^3.4.*', '3.4'],
            '^3.4' => ['^3.4', '3'],
            '^3.4.9' => ['^3.4.9', '3.4'],
            '~3' => ['~3', '3'],
            '~3.4' => ['~3.4', '3'],
            '~3.4.9' => ['~3.4.9', '3.4'],
            '3' => ['3', '3'],
            '3.4' => ['3.4', '3.4'],
            '3.4.9' => ['3.4.9', '3.4.9'],
            '3.*' => ['3.*', '3'],
            '3.4.*' => ['3.4.*', '3.4'],
            'v3' => ['v3', '3'],
            'v3.4' => ['v3.4', '3.4'],
            'v3.4.9' => ['v3.4.9', '3.4.9'],
            'v3.*' => ['v3.*', '3'],
            'v3.4.*' => ['v3.4.*', '3.4'],
            '*' => ['*', null],

            // Not handled for now
            '>1.0.*' => ['>1.0.*', null],
            '>=1.0' => ['>=1.0', null],
            '>=1.0 || 8.*' => ['>=1.0 || 8.*', null],
            '>=1.0; <2.0' => ['>=1.0; <2.0', null],
        ];
    }
}
