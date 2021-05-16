<?php

class CalculatorTest extends \PHPUnit\Framework\TestCase
{
    public function testCanSetSingleOperation()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([5, 20]);
        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperation($addition);

        $this->assertCount(1, $calculator->getOperations());
    }

    public function testCanSetMultipleOperations()
    {
        $addition1 = new \App\Calculator\Addition;
        $addition1->setOperands([5, 20]);
        $addition2 = new \App\Calculator\Addition;
        $addition2->setOperands([10, 12]);
        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition1, $addition2]);

        $this->assertCount(2, $calculator->getOperations());
    }

    public function testOperationsIgnoredIfNotInstanceOfOperationInterface()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([5, 20]);
        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition, 'hello']);

        $this->assertCount(1, $calculator->getOperations());
    }

    public function testCanCalculateResult()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([5, 10, 15]);
        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition, 'hello']);

        $this->assertEquals(30, $calculator->calculate());
    }

    public function testCalculateMethodReturnsMultipleResults()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([5, 10, 15]);
        $division = new \App\Calculator\Division;
        $division->setOperands([100, 50, 2]);
        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition, 'hello', $division]);

        $this->assertInternalType('array', $calculator->calculate());
        $this->assertEquals(30, $calculator->calculate()[0]);
        $this->assertEquals(1, $calculator->calculate()[1]);
    }
}
