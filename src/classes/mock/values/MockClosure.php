<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockClosure as MockClosureInterface;
use \closure;

class MockClosure implements MockClosureInterface
{

    public function value(): closure
    {
        return function(): void {};
    }
}

