<?php

declare(strict_types=1);

namespace LupusCoding\DinValidator\Helper;

/**
 * Class EncodingConverter
 * @package LupusCoding\DinValidator\Helper
 * @author Ralph Dittrich <dittrich.ralph@lupuscoding.de>
 */
class EncodingConverter
{
    /** @return int|false */
    public static function utf8ToUnicode(string $utf8Character)
    {
        return mb_ord($utf8Character, 'utf-8');
    }

    /** @return string|false */
    public static function unicodeToUtf8(int $unicodePoint)
    {
        return mb_chr($unicodePoint, 'utf-8');
    }
}