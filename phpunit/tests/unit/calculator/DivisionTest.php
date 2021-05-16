<?php

class DivisionTest extends \PHPUnit\Framework\TestCase
{
    public function testDividesGivenOperands()
    {
        $division = new \App\Calculator\Division;
        $division->setOperands([100, 20]);

        $this->assertEquals(5, $division->calculate());
    }

    public function testIgnoresDivisionByZeroOperands()
    {
        $division = new \App\Calculator\Division;
        $division->setOperands([10, 0, 0, 5, 0]);

        $this->assertEquals(2, $division->calculate());
    }

    public function testNoOperandsThrowsExceptionWhenCalculating()
    {
        $exception = \App\Calculator\Exceptions\NoOperandsException::class;
        $this->expectException($exception);

        $division = new \App\Calculator\Division;
        $division->calculate();
    }
}
