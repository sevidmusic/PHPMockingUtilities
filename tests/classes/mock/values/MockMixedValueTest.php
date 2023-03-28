<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue;
use Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockMixedValueTestTrait;

class MockMixedValueTest extends PHPMockingUtilitiesTest
{

    /**
     * The MockMixedValueTestTrait defines
     * common tests for implementations of the
     * Darling\PHPMockingUtilities\interfaces\mock\values\MockMixedValue
     * interface.
     *
     * @see MockMixedValueTestTrait
     *
     */
    use MockMixedValueTestTrait;

    protected function setUp(): void
    {
        $this->setMockMixedValueTestInstance(
            new MockMixedValue()
        );
    }

}

