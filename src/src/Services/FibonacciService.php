<?php

namespace App\Services;

class FibonacciService extends FibonacciGenerator
{
    const DATE_TIMEZONE = 'UTC';

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
        if (Helpers::isStringValidDate($init) && Helpers::isStringValidDate($end)) {
            return $this->generateNumbers(strtotime($init), strtotime($end));
        }

        throw new \Exception('Invalid input date format', 400);
    }

}