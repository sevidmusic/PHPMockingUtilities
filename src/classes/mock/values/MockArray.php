<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockArray as MockArrayInterface;

class MockArray implements MockArrayInterface
{

    public function value(): array
    {
        return [];
    }

}

