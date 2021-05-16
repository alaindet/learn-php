<?php

class AdditionTest extends \PHPUnit\Framework\TestCase
{
    public function testAddsUpGivenOperands()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([5,10]);

        $this->assertEquals(15, $addition->calculate());
    }

    public function testNoOperandsThrowsExceptionWhenCalculating()
    {
        $exception = \App\Calculator\Exceptions\NoOperandsException::class;
        $this->expectException($exception);

        $addition = new \App\Calculator\Addition;
        $addition->calculate();
    }
}
