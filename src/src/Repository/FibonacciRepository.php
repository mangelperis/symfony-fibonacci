<?php

namespace App\Repository;

use App\Controller\FibonacciGenerator;

class FibonacciRepository extends FibonacciGenerator
{
    const DATE_TIMEZONE = 'UTC';
    const DATETIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * @return array
     */
    public function numbersCurrentMonth(): array
    {
        $init = new \DateTime('first day of this month');
        $init->setTimezone(new \DateTimeZone(self::DATE_TIMEZONE))
            ->setTime(00, 00, 00);

        $end = new \DateTime('last day of this month');
        $end->setTimezone(new \DateTimeZone(self::DATE_TIMEZONE))
            ->setTime(23, 59, 59);

        return $this->generateNumbers($init->getTimestamp(), $end->getTimestamp());
    }

    /**
     * @return array
     */
    public function numbersCurrentYear(): array
    {

        $init = new \DateTime('first day of this year');
        $init->setTimezone(new \DateTimeZone(self::DATE_TIMEZONE))
            ->setTime(00, 00, 00);

        $end = new \DateTime('last day of this year');
        $end->setTimezone(new \DateTimeZone(self::DATE_TIMEZONE))
            ->setTime(23, 59, 59);

        return $this->generateNumbers($init->getTimestamp(), $end->getTimestamp());
    }


    /**
     * @param string $init
     * @param string $end
     * @return array
     * @throws \Exception
     */
    public function numbersBetweenDates(string $init, string $end): array
    {
        if ($this->isStringValidDate($init) && $this->isStringValidDate($end)) {
            return $this->generateNumbers(strtotime($init), strtotime($end));
        }

        throw new \Exception('Invalid input date format', 400);
    }


    /**
     * @param $string
     * @param string $format
     * @return bool
     */
    public function isStringValidDate($string, string $format = self::DATETIME_FORMAT): bool
    {
        $d = \DateTime::createFromFormat($format, $string);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.

        return $d && $d->format($format) === $string;
    }
}