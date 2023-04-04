<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockInt as MockIntInterface;

class MockInt implements MockIntInterface
{

    private int $int;

    public function __construct()
    {
        $this->int = rand(PHP_INT_MIN, PHP_INT_MAX);
    }

    public function value(): int
    {
        return $this->int;
    }
}

