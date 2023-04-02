<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use Darling\PHPMockingUtilities\classes\mock\values\MockString;
use Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockStringTestTrait;

class MockStringTest extends PHPMockingUtilitiesTest
{

    /**
     * The MockStringTestTrait defines
     * common tests for implementations of the
     * Darling\PHPMockingUtilities\interfaces\mock\values\MockString
     * interface.
     *
     * @see MockStringTestTrait
     *
     */
    use MockStringTestTrait;

    public function setUp(): void
    {
        $mockString = new MockString();
        $this->setMockStringTestInstance($mockString);
        $this->setExpectedString($mockString->__toString());
        $this->setTextTestInstance($mockString);
    }
}

