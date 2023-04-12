<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance;
use \Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use \Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockClassInstanceTestTrait;
use \Darling\PHPMockingUtilities\tests\mock\abstractions\AbstractImplementationOfInterfaceForClassThatDefinesMethods;
use \Darling\PHPMockingUtilities\tests\mock\classes\ClassThatDoesNotDefineMethods;
use \Darling\PHPMockingUtilities\tests\mock\classes\ImplementationOfInterfaceForClassThatDefinesMethods;
use \Darling\PHPMockingUtilities\tests\mock\interfaces\InterfaceForClassThatDefinesMethods;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection;
use \Darling\PHPReflectionUtilities\interfaces\utilities\Reflection as ReflectionInterface;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPTextTypes\interfaces\strings\Name as NameInterface;
use \Darling\PHPTextTypes\interfaces\strings\Text as TextInterface;
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

    public function setUp(): void
    {
        $randomClassStringOrObjectInstance = $this->randomClassStringOrObjectInstance();
        $expectedReflection = new Reflection(
            new ReflectionClass(
                $randomClassStringOrObjectInstance
            )
        );
        $this->setExpectedReflection($expectedReflection);
        $this->setMockClassInstanceTestInstance(
            new MockClassInstance($expectedReflection)
        );
    }

    /**
     * Return a random fully qualified class name, or object instance.
     *
     * @return class-string|object
     *
     * @example
     *
     * ```
     * var_dump($this->randomClassStringOrObjectInstance);
     *
     * // example output:
     * string(8) "stdClass"
     *
     * ```
     *
     */
    public function randomClassStringOrObjectInstance(): string|object
    {
        /** @var array<int, class-string|object> $classes */
        $classes = [
            AbstractImplementationOfInterfaceForClassThatDefinesMethods::class,
            ClassThatDoesNotDefineMethods::class,
            ImplementationOfInterfaceForClassThatDefinesMethods::class,
            new ImplementationOfInterfaceForClassThatDefinesMethods(),
            InterfaceForClassThatDefinesMethods::class,
            Name::class,
            NameInterface::class,
            Text::class,
            TextInterface::class,
            new ClassThatDoesNotDefineMethods(),
            new Name(new Text($this->randomChars())),
            new Text($this->randomChars()),
            new stdClass(),
            stdClass::class
        ];
        return (empty($classes) ? new stdClass() : $classes[array_rand($classes)]);
    }
}

