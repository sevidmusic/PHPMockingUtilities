<?php

namespace Darling\PHPMockingUtilities\tests\classes\mock\values;

use Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance;
use Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockClassInstanceTestTrait;
use Darling\PHPReflectionUtilities\classes\utilities\Reflection;
use Darling\PHPReflectionUtilities\interfaces\utilities\Reflection as ReflectionInterface;
use Darling\PHPTextTypes\classes\strings\Name;
use Darling\PHPTextTypes\interfaces\strings\Name as NameInterface;
use Darling\PHPTextTypes\classes\strings\Text;
use Darling\PHPTextTypes\interfaces\strings\Text as TextInterface;
use \ReflectionClass;
use \Stringable;

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
            ClassThatDoesNotDefineMethods::class,
            new ClassThatDoesNotDefineMethods(),
            ClassThatDoesDefineMethods::class, # fails
            new ClassThatDoesDefineMethods(),
            ClassThatExtendsAbstractClass::class,
            new ClassThatExtendsAbstractClass($this->randomChars()),
            Text::class,
            new Text($this->randomChars()),
            new Name(new Text($this->randomChars())),
            Name::class,
            NameInterface::class,
            TextInterface::class,
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

interface InterfaceForClass
{
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
        ClassThatDoesDefineMethods $classThatDoesDefineMethods,
        ClassThatDoesNotDefineMethods $classThatDoesNotDefineMethods,
        Stringable $stringable,
        \Closure $closure,
        \Darling\PHPTextTypes\classes\strings\Id $id,
        \Darling\PHPTextTypes\interfaces\strings\Text $text,
        array $array,
        bool $bool,
        float $float,
        int $int,
        mixed $mixed,
        null|bool|int $nullableParameter,
        object $object, # fails
        string $string,
        string|array $moreThanOneTypeAccepted,
        mixed ...$mixedVariadic,
    ): void;
}

abstract class AbstractClassThatImplementsAndInterface implements InterfaceForClass
{

    public function __construct(public string $stringProperty) {}

    abstract public function methodWithArguments(
        ClassThatDoesDefineMethods $classThatDoesDefineMethods,
        ClassThatDoesNotDefineMethods $classThatDoesNotDefineMethods,
        Stringable $stringable,
        \Closure $closure,
        \Darling\PHPTextTypes\classes\strings\Id $id,
        \Darling\PHPTextTypes\interfaces\strings\Text $text,
        array $array,
        bool $bool,
        float $float,
        int $int,
        mixed $mixed,
        null|bool|int $nullableParameter,
        object $object, # fails
        string $string,
        string|array $moreThanOneTypeAccepted,
        mixed ...$mixedVariadic,
    ): void;

}

class ClassThatExtendsAbstractClass extends AbstractClassThatImplementsAndInterface implements InterfaceForClass
{
    public function methodWithArguments(
        ClassThatDoesDefineMethods $classThatDoesDefineMethods,
        ClassThatDoesNotDefineMethods $classThatDoesNotDefineMethods,
        Stringable $stringable,
        \Closure $closure,
        \Darling\PHPTextTypes\classes\strings\Id $id,
        \Darling\PHPTextTypes\interfaces\strings\Text $text,
        array $array,
        bool $bool,
        float $float,
        int $int,
        mixed $mixed,
        null|bool|int $nullableParameter,
        object $object, # fails
        string $string,
        string|array $moreThanOneTypeAccepted,
        mixed ...$mixedVariadic,
    ): void {}
}

class ClassThatDoesDefineMethods
{
/*
 * These fail, types that indicate an interface or abstract class
 * cause failure.
 *
 * This does not apply to interfaces defined by Darling libraries
 * since they follow a namespace naming pattern that is accommodated
 * by the PHPMockingUtilities library.
 *
 * @todo
 * There may not be a way around this, the documentation must
 * point this out, and there should be tests defined to determine
 * hose interfaces and abstract class types are handled.
 *
    public function acceptsImplementationOfInterface(
        InterfaceForClass $acceptsImplementationOfInterface, # fails
    ): void {}

 */

    public function acceptsVariousTypes(
        InterfaceForClass $acceptsImplementationOfInterface, # fails
        AbstractClassThatImplementsAndInterface $acceptsImplementationOfAbstractClass, #fails
        ClassThatDoesDefineMethods $classThatDoesDefineMethods,
        ClassThatDoesNotDefineMethods $classThatDoesNotDefineMethods,
        Stringable $stringable,
        \Closure $closure,
        \Darling\PHPTextTypes\classes\strings\Id $id,
        \Darling\PHPTextTypes\interfaces\strings\Text $text,
        bool $bool,
        float $float,
        int $int,
        mixed $mixed,
        null|bool|int $nullableParameter,
        object $object, # fails
        string $string,
        mixed ...$mixedVariadic,
    ): void
    {
    }
}

class ClassThatDoesNotDefineMethods
{

}
