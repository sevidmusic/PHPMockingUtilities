<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockFloat as MockFloatInterface;

class MockFloat implements MockFloatInterface
{

    private float $value;

    public function __construct()
    {
        $this->value = $this->randomFloat();
    }

    public function value(): float
    {
        return $this->value;
    }

    private function randomFloat(): float
    {
        return rand(1000000, 9999999) / rand(3, 9);
    }
}

