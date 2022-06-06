<?php

declare(strict_types=1);

namespace LupusCoding\DinValidator\Tests;

use LupusCoding\DinValidator\Helper\EncodingConverter;
use PHPUnit\Framework\TestCase;
use LupusCoding\DinValidator\Specs\DinSpec91379;

/**
 * Class DinSpec91379Test
 * @package LupusCoding\DinValidator\Tests
 * @author Ralph Dittrich <dittrich.ralph@lupuscoding.de>
 * @covers LupusCoding\DinValidator\Specs\DinSpec91379;
 */
class DinSpec91379Test extends TestCase
{
    /**
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isLatinCharacter
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isLatinUnicodePoint
     */
    public function testIsLatinCharacter(): void
    {
        $chars = [
            'a' => true,
            'ö' => true,
            '´' => false,
            '÷' => false,
            'Ě' => true,
        ];

        $validator = new DinSpec91379();

        foreach ($chars as $char => $expected) {
            $actual = $validator->isLatinCharacter($char);
            $this->assertEquals($expected, $actual, 'Wrong assertion on char "' . $char . '"');
        }
    }

    /**
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isDiacriticalCombinationCharacter
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isDiacriticalCombinationUnicodePoint
     */
    public function testIsDiacriticalCombinationCharacter(): void
    {
        $chars = [
            EncodingConverter::unicodeToUtf8(0x0302) => true,
            EncodingConverter::unicodeToUtf8(0x002c) => false,
            EncodingConverter::unicodeToUtf8(0x0315) => true,
            EncodingConverter::unicodeToUtf8(0x2019) => false,
            EncodingConverter::unicodeToUtf8(0x035f) => true,
        ];

        $validator = new DinSpec91379();

        foreach ($chars as $char => $expected) {
            $actual = $validator->isDiacriticalCombinationCharacter($char);
            $this->assertEquals($expected, $actual, 'Wrong assertion on char "' . $char . '"');
        }
    }

    /**
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isNonLetterN1Character
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isNonLetterN1UnicodePoint
     */
    public function testIsNonLetterN1Character(): void
    {
        $chars = [
            ' ' => true,
            '!' => false,
            '²' => false,
            '´' => true,
            '¨' => true,
        ];

        $validator = new DinSpec91379();

        foreach ($chars as $char => $expected) {
            $actual = $validator->isNonLetterN1Character($char);
            $this->assertEquals($expected, $actual, 'Wrong assertion on char "' . $char . '"');
        }
    }

    /**
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isNonLetterN2Character
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isNonLetterN2UnicodePoint
     */
    public function testIsNonLetterN2Character(): void
    {
        $chars = [
            '¤' => false,
            '*' => true,
            '«' => true,
            '<' => true,
            '¾' => false,
        ];

        $validator = new DinSpec91379();

        foreach ($chars as $char => $expected) {
            $actual = $validator->isNonLetterN2Character($char);
            $this->assertEquals($expected, $actual, 'Wrong assertion on char "' . $char . '"');
        }
    }

    /**
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isNonLetterN3Character
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isNonLetterN3UnicodePoint
     */
    public function testIsNonLetterN3Character(): void
    {
        $chars = [
            '¦' => true,
            '¸' => true,
            '½' => true,
            '	' => false,
            ' ' => false,
        ];

        $validator = new DinSpec91379();

        foreach ($chars as $char => $expected) {
            $actual = $validator->isNonLetterN3Character($char);
            $this->assertEquals($expected, $actual, 'Wrong assertion on char "' . $char . '"');
        }
    }

    /**
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isNonLetterN4Character
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isNonLetterN4UnicodePoint
     */
    public function testIsNonLetterN4Character(): void
    {
        $chars = [
            'ƥ' => false,
            'ä' => false,
            EncodingConverter::unicodeToUtf8(0x0009) => true,
            EncodingConverter::unicodeToUtf8(0x000d) => true,
            EncodingConverter::unicodeToUtf8(0x00a0) => true,
        ];

        $validator = new DinSpec91379();

        foreach ($chars as $char => $expected) {
            $actual = $validator->isNonLetterN4Character($char);
            $this->assertEquals($expected, $actual, 'Wrong assertion on char "' . $char . '"');
        }
    }

    /**
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isStringValid
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::handleMultiUnicodeCharacters
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::getDiacriticalSubstring
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::getUnicodeCharacters
     * @covers \LupusCoding\DinValidator\Specs\DinSpec91379::isValidUnicodePoint
     */
    public function testIsStringValid(): void
    {
        $validator = new DinSpec91379();
        $testStrings = [
            'This is an example sentence' => true,
            '这是一个例句' => false,
            'Bu bir örnek cümledir' => true,
            'นี่คือตัวอย่างประโยค' => false,
            'Esta es una oración de ejemplo' => true,
        ];

        foreach ($testStrings as $string => $expected) {
            $actual = $validator->isStringValid($string);
            $this->assertEquals($expected, $actual, 'Wrong assertion on $string "' . $string . '"');
        }
    }
}