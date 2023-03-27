<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use Darling\PHPMockingUtilities\classes\mock\values\MockValue;
use Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockValueTestTrait;

class MockValueTest extends PHPMockingUtilitiesTest
{

    /**
     * The MockValueTestTrait defines
     * common tests for implementations of the
     * Darling\PHPMockingUtilities\interfaces\mock\values\MockValue
     * interface.
     *
     * @see MockValueTestTrait
     *
     */
    use MockValueTestTrait;

    protected function setUp(): void
    {
        $this->setMockValueTestInstance(
            new MockValue()
        );
    }

}

