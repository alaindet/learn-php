<?php

namespace App\Calculator;

use App\Calculator\Exceptions\NoOperandsException;

class Addition extends OperationAbstract implements OperationInterface
{
    public function calculate()
    {
        if (empty($this->operands)) {
            throw new NoOperandsException;
        }

        return array_sum($this->operands);
    }
}
