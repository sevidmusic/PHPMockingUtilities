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
            new \stdClass(),
            ClassThatDoesDefineMethods::class,
            ClassThatDoesDefineMethods::class,
            new ClassThatDoesNotDefineMethods(),
            new ClassThatDoesDefineMethods(),
            parent::randomClassStringOrObjectInstance(),
        ];
        return $classes[array_rand($classes)];
    }
}

/**
 * The following classes are defined here for use by
 * the MockClassInstanceTest
 *
 * @todo Move test classes into their own files
 *
 */

class ClassThatDoesNotDefineMethods
{

}

class ClassThatDoesDefineMethods
{

    public function __constuct(int $int, bool $bool): void {}

    public function methodWithoutArguments(): void {}

    /**
     * A method that expects arguments.
     *
     * @param array<mixed> $array
     * @param string|array<mixed> $moreThanOneTypeAccepted
     *
     * @return void
     *
     * @example
     *
     * ```
     *
     * ```
     *
     */
    public function methodWithArguments(
        string $string,
        int $int,
        bool $bool,
        float $float,
        array $array,
        object $object,
        mixed $mixed,
        string|array $moreThanOneTypeAccepted,
        ClassThatDoesNotDefineMethods $classWithoutMethods,
        ClassThatDoesDefineMethods $classWithMethods,
        null|bool|int $nullableParameter,
    ): void
    {
    }
}
