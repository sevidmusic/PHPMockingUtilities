<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use Darling\PHPMockingUtilities\classes\mock\values\MockInt;
use Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockIntTestTrait;

class MockIntTest extends PHPMockingUtilitiesTest
{

    /**
     * The MockIntTestTrait defines common tests for implementations
     * of the following interface:
     *
     * Darling\PHPMockingUtilities\interfaces\mock\values\MockInt
     *
     * @see MockIntTestTrait
     *
     */
    use MockIntTestTrait;

    public function setUp(): void
    {
        $this->setMockIntTestInstance(
            new MockInt()
        );
    }
}

