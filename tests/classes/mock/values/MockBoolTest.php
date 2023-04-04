<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use Darling\PHPMockingUtilities\classes\mock\values\MockBool;
use Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockBoolTestTrait;

class MockBoolTest extends PHPMockingUtilitiesTest
{

    /**
     * The MockBoolTestTrait defines
     * common tests for implementations of the
     * Darling\PHPMockingUtilities\interfaces\mock\values\MockBool
     * interface.
     *
     * @see MockBoolTestTrait
     *
     */
    use MockBoolTestTrait;

    public function setUp(): void
    {
        $this->setMockBoolTestInstance(
            new MockBool()
        );
    }
}

