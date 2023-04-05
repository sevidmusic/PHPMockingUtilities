<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance;
use Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockClassInstanceTestTrait;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection;
use \Darling\PHPReflectionUtilities\interfaces\utilities\Reflection as ReflectionInterface;
use \ReflectionClass;

class MockClassInstanceTest extends PHPMockingUtilitiesTest
{

    /**
     * The MockClassInstanceTestTrait defines
     * common tests for implementations of the
     * Darling\PHPMockingUtilities\interfaces\mock\values\MockClassInstance
     * interface.
     *
     * @see MockClassInstanceTestTrait
     *
     */
    use MockClassInstanceTestTrait;

    public function setUp(): void
    {
        $expectedReflection = new Reflection(
            new ReflectionClass(new \stdClass()) # todo: use random class instance
        );
        $this->setExpectedReflection($expectedReflection);
        $this->setMockClassInstanceTestInstance(
            new MockClassInstance($expectedReflection)
        );
    }
}

