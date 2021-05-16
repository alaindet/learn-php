<?php

namespace App\Calculator;

class Calculator
{
    protected $operations = [];

    public function setOperation(OperationInterface $operation)
    {
        $this->operations[] = $operation;
    }

    public function setOperations(array $operations)
    {
        $filteredOperations = array_filter($operations, function ($operation) {
            return $operation instanceof OperationInterface;
        });

        foreach ($filteredOperations as $operation) {
            $this->setOperation($operation);
        }
    }

    public function getOperations()
    {
        return $this->operations;
    }

    public function calculate()
    {
        $results = array_map(function ($operation) {
            return $operation->calculate();
        }, $this->operations);

        return count($results) === 1 ? $results[0] : $results;
    }
}
