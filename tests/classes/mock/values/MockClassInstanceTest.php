<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance;
use \Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use \Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockClassInstanceTestTrait;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \ReflectionClass;
use \Stringable;
use \stdClass;

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

    protected function setUp(): void
    {
        $randomClassStringOrObjectInstance =
            $this->randomClassStringOrObjectInstance();
        $classString =
            new ClassString(
                $randomClassStringOrObjectInstance
            );
        $expectedReflection = new Reflection($classString);
        $this->setExpectedReflection($expectedReflection);
        $this->setMockClassInstanceTestInstance(
            new MockClassInstance(
                $expectedReflection
            )
        );
    }

}

