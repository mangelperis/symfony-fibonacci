<?php

namespace App\Controller;

class FibonacciGenerator
{
    /**
     * @param int $init
     * @param int $end
     * @return array
     */
    protected function generateNumbers(int $init, int $end): array
    {
        // Initialize first three Fibonacci Numbers
        $f1 = 0;
        $f2 = 1;
        $f3 = 0;

        // Count fibonacci numbers in given range
        $count = 0;

        //Array Numbers in given range
        $numbers = [];

        while ($f3 <= $end) {
            if ($f3 >= $init) {
                $count++;
                $numbers[] = $f3;
            }
            $f1 = $f2;  // Copy n-1 to n-2
            $f2 = $f3; // Copy current to n-1
            $f3 = $f1 + $f2; // New term
        }

        return $numbers;
    }

}