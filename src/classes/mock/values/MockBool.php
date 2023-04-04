<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockBool as MockBoolInterface;

class MockBool implements MockBoolInterface
{

    public function value(): bool
    {
        return false;
    }

}

