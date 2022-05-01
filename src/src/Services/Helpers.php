<?php

namespace App\Services;

class Helpers
{
    const DATETIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * @param $string
     * @param string $format
     * @return bool
     */
    public static function isStringValidDate($string, string $format = self::DATETIME_FORMAT): bool
    {
        $d = \DateTime::createFromFormat($format, $string);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.

        return $d && $d->format($format) === $string;
    }
    
}