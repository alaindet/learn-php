<?php

namespace App\Calculator;

use App\Calculator\Exceptions\NoOperandsException;

class Division extends OperationAbstract implements OperationInterface
{
    public function calculate()
    {
        if (empty($this->operands)) {
            throw new NoOperandsException;
        }

        return array_reduce($this->operands, function ($result, $operand) {

            // Ignore operands = 0 (division by zero)
            if ($operand === 0) {
                return $result;
            }

            if ($result !== null && $operand !== null) {
                return $result / $operand;
            }

            return $operand;

        }, null);

    }
}
