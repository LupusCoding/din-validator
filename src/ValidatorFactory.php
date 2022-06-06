<?php

declare(strict_types=1);

namespace LupusCoding\DinValidator;

use LupusCoding\DinValidator\Specs\DinSpec91379;

/**
 * Class ValidatorFactory
 * @package LupusCoding\DinValidator
 * @author Ralph Dittrich <dittrich.ralph@lupuscoding.de>
 */
class ValidatorFactory
{
    /** Validate a string for DIN SPEC 91379 */
    public static function validateDinSpec91379(string $string): bool
    {
        $validator = new DinSpec91379();
        return $validator->isStringValid($string);
    }
}