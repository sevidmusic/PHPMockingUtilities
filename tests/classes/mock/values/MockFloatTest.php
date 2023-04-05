<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use Darling\PHPMockingUtilities\classes\mock\values\MockFloat;
use Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockFloatTestTrait;

class MockFloatTest extends PHPMockingUtilitiesTest
{

    /**
     * The MockFloatTestTrait defines common tests for
     * implementations of the following interface:
     *
     * Darling\PHPMockingUtilities\interfaces\mock\values\MockFloat
     *
     * @see MockFloatTestTrait
     *
     */
    use MockFloatTestTrait;

    public function setUp(): void
    {
        $this->setMockFloatTestInstance(
            new MockFloat()
        );
    }
}

