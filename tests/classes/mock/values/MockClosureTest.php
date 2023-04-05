<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use Darling\PHPMockingUtilities\classes\mock\values\MockClosure;
use Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockClosureTestTrait;

class MockClosureTest extends PHPMockingUtilitiesTest
{

    /**
     * The MockClosureTestTrait defines
     * common tests for implementations of the
     * Darling\PHPMockingUtilities\interfaces\mock\values\MockClosure
     * interface.
     *
     * @see MockClosureTestTrait
     *
     */
    use MockClosureTestTrait;

    public function setUp(): void
    {
        $this->setMockClosureTestInstance(
            new MockClosure()
        );
    }
}

