<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use Darling\PHPMockingUtilities\classes\mock\values\MockArray;
use Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockArrayTestTrait;

class MockArrayTest extends PHPMockingUtilitiesTest
{

    /**
     * The MockArrayTestTrait defines
     * common tests for implementations of the
     * Darling\PHPMockingUtilities\interfaces\mock\values\MockArray
     * interface.
     *
     * @see MockArrayTestTrait
     *
     */
    use MockArrayTestTrait;

    public function setUp(): void
    {
        $this->setMockArrayTestInstance(
            new MockArray()
        );
    }
}

