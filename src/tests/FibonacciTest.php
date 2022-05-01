<?php

namespace App\Tests;

use App\Services\FibonacciService;
use App\Services\Helpers;
use PHPUnit\Framework\TestCase;

class FibonacciTest extends TestCase
{
    private $fibonacciService;

    protected function setUp(): void
    {
        $this->fibonacciService = new FibonacciService();

    }

    public function testStringValidatorHelper()
    {
        $validDate = '2022-03-01 00:00:00';
        $this->assertTrue(Helpers::isStringValidDate($validDate));

        $noHisDate = '2022-03-01';
        $this->assertFalse(Helpers::isStringValidDate($noHisDate));

        $invalidFormatDate = '2022/03/01 00:00:00';
        $this->assertFalse(Helpers::isStringValidDate($invalidFormatDate));
    }


    /**
     * @throws \Exception
     */
    public
    function testApplicationGenerator()
    {
        //There are five Fibonacci numbers in given range (10-100)
        $from = '1970-01-01 00:00:10';
        $to = '1970-01-01 00:01:40';

        $result = $this->fibonacciService->numbersBetweenDates($from, $to);

        $this->assertIsArray($result);
        $this->assertCount(5, $result);
    }

    /**
     * @throws \Exception
     */
    public
    function testApplicationGenerator2()
    {
        //There are five Fibonacci numbers in given range (10-100)
        $from = '1970-01-01 00:00:10';
        $to = '1970-01-01 00:01:40';

        $helpersMock = $this->createMock(Helpers::class);

        $helpersMock->method('isStringValidDate2')->willReturn(true);

        $result = $this->fibonacciService->numbersBetweenDates($from, $to);

        $helpersMock->expects($this->exactly(1))->method('isStringValidDate2')->with(
            'from'
        );
        $helpersMock->expects($this->exactly(1))->method('isStringValidDate2')->with(
            'to'
        );

    }


    /**
     * @throws \Exception
     */
    public
    function testBadParamsExec()
    {
        $from = '1970/01/01 00:00:10';
        $to = '1970-01-01 00:01:40';

        $this->expectExceptionCode(400);
        $result = $this->fibonacciService->numbersBetweenDates($from, $to);

        $this->assertIsNotArray($result);
    }
}
