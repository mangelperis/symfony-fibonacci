<?php

namespace App\Tests;

use App\Repository\FibonacciRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FibonacciTest extends WebTestCase
{
    private $fibonacciRepository;

    protected function setUp(): void
    {
        $this->fibonacciRepository = new FibonacciRepository();
    }

    public function testStringValidatorHelper()
    {
        $validDate = '2022-03-01 00:00:00';
        $this->assertTrue($this->fibonacciRepository->isStringValidDate($validDate));

        $noHisDate = '2022-03-01';
        $this->assertFalse($this->fibonacciRepository->isStringValidDate($noHisDate));

        $invalidFormatDate = '2022/03/01 00:00:00';
        $this->assertFalse($this->fibonacciRepository->isStringValidDate($invalidFormatDate));
    }


    public
    function testApplicationGenerator()
    {
        //There are five Fibonacci numbers in given range (10-100)
        $from = '1970-01-01 00:00:10';
        $to = '1970-01-01 00:01:40';

        $result = $this->fibonacciRepository->numbersBetweenDates($from, $to);

        $this->assertIsArray($result);
        $this->assertCount(5, $result);
    }


    public
    function testBadParamsExec()
    {
        $from = '1970/01/01 00:00:10';
        $to = '1970-01-01 00:01:40';

        $this->expectExceptionCode(400);
        $result = $this->fibonacciRepository->numbersBetweenDates($from, $to);

        $this->assertIsNotArray($result);
    }
}
