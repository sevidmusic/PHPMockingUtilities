<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use \Darling\PHPMockingUtilities\interfaces\mock\values\MockClassInstance;
use \Darling\PHPReflectionUtilities\interfaces\utilities\Reflection;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection as ReflectionInstance;
use \Darling\PHPTextTypes\classes\strings\UnknownClass;
use \ReflectionClass;
use \Stringable;

/**
 * The MockClassInstanceTestTrait defines common tests for
 * implementations of the MockClassInstance interface.
 *
 * @see MockClassInstance
 *
 */
trait MockClassInstanceTestTrait
{

    /**
     * @var Reflection $expectedReflection The Reflection instance
     *                                     that is expected to be
     *                                     assigned to the
     *                                     MockClassInstance being
     *                                     tested.
     */
    private Reflection $expectedReflection;

    /**
     * @var MockClassInstance $mockClassInstance An instance of a
     *                                           MockClassInstance
     *                                           implementation to
     *                                           test.
     */
    protected MockClassInstance $mockClassInstance;

    /**
     * Set up an instance of a MockClassInstance implementation to
     * test.
     *
     * This method must set the MockClassInstance
     * implementation instance to be tested via the
     * setMockClassInstanceTestInstance() method.
     *
     * This method must also set the Reflection instance that is
     * expected to be returned by the MockClassInstance's reflection()
     * method via the setExpectedReflection() method.
     *
     * This method may also be used to perform any additional setup
     * required by the implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUp(): void
     * {
     *     $expectedReflection = new Reflection(
     *         new ReflectionClass(new \stdClass())
     *     );
     *     $this->setExpectedReflection($expectedReflection);
     *     $this->setMockClassInstanceTestInstance(
     *         new \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the MockClassInstance implementation instance to test.
     *
     * @return MockClassInstance
     *
     */
    protected function mockClassInstanceTestInstance(): MockClassInstance
    {
        return $this->mockClassInstance;
    }

    /**
     * Set the MockClassInstance implementation instance to test.
     *
     * @param MockClassInstance $mockClassInstanceTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the MockClassInstance
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setMockClassInstanceTestInstance(
        MockClassInstance $mockClassInstanceTestInstance
    ): void
    {
        $this->mockClassInstance = $mockClassInstanceTestInstance;
    }

    /**
     * Set the Reflection instance that is expected to be returned
     * by the MockClassInstance's reflection() method.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $expectedReflection = new Reflection(
     *     new ReflectionClass(new \stdClass())
     * );
     * $this->setExpectedReflection($expectedReflection);
     *
     * ```
     *
     */
    protected function setExpectedReflection(Reflection $reflection): void
    {
        $this->expectedReflection = $reflection;
    }

    /**
     * Return the Reflection instance that is expected to be
     * returned by the MockClassInstance's reflection() method.
     *
     * @return Reflection
     *
     * @example
     *
     * ```
     * $this->expectedReflection();
     *
     * ```
     *
     */
    protected function expectedReflection(): Reflection
    {
        return $this->expectedReflection;
    }

    /**
     * Return the class string of the specified $class.
     *
     * $class may be a class string, or an object instance.
     *
     * @return class-string<object>
     *
     * @example
     *
     * ```
     * var_dump($this->determineClassString(\stdClass::class);
     *
     * // example output:
     * string(8) "stdClass"
     *
     * var_dump($this->determineClassString(new \stdClass());
     *
     * // example output:
     * string(8) "stdClass"
     *
     * ```
     *
     */
    protected function determineClassString(string|object $class): string
    {
        return match(is_object($class)) {
            true => $class::class,
            default => $this->validateClassString($class),
        };
    }


    /**
     * Validate the specified $classString.
     *
     * If the specified $classString does not correspond to an
     * existing class, then the class string for an UnknownClass
     * will be returned.
     *
     * If the $classString corresponds to an interface or abstract
     * class that is not defined under a Darling namespace, then
     * the class string for an UnknownClass will be returned.
     *
     * If the $classString corresponds to a interface or abstract
     * class that is defined under a Darling namespace, then it
     * will be modified to reflect the appropriate Darling class.
     *
     * For example, the following $classString:
     *
     * ```
     * Darling\\LibraryName\\interfaces\\Foo\\Bar\\Baz
     *
     * ```
     *
     * Would be modified to be:
     *
     * ```
     * Darling\\LibraryName\\classes\\Foo\\Bar\\Baz
     *
     * ```
     *
     * If the specified class string corresponds to an existing
     * class that is not abstract, then it will be returned
     * unmodified.
     *
     * @return class-string<object>
     *
     * @example
     *
     * ```
     * var_dump($this->validateClassString(\stdClass::class);
     *
     * // example output:
     * string(8) "stdClass"
     *
     * var_dump(
     *     $this->validateClassString(
     *         "Darling\\PHPTextTypes\\interfaces\\strings\\Name"
     *     )
     * );
     *
     * // example output:
     * string(41) "Darling\\PHPTextTypes\\classes\\strings\\Name"
     *
     * ```
     *
     */
    private function validateClassString(string $classString): string
    {
        if(!interface_exists($classString) && !class_exists($classString)) {
            return UnknownClass::class;
        }
        $this->correctDarlingNamespaces($classString);
        $reflectionClass = new \ReflectionClass($classString);
        return match(
            $reflectionClass->isInterface()
            ||
            $reflectionClass->isAbstract()
        ) {
            true => UnknownClass::class,
            default => $classString,
        };
    }

    protected function correctDarlingNamespaces(string &$class): void
    {
        if(
            substr($class, 0, 7) === 'Darling'
            &&
            !str_contains($class, '\\tests\\')
            &&
            $class !== UnknownClass::class
        ) {
            $class = str_replace(
                ['interfaces', 'abstractions'],
                'classes',
                $class
            );
        }
    }

    /**
     * Test that the reflection method returns the expected
     * Reflection.
     *
     * @covers MockClassInstance->reflection()
     *
     */
    public function testReflectionReturnsTheExpectedReflection(): void
    {
        $this->assertEquals(
            $this->expectedReflection(),
            $this->mockClassInstanceTestInstance()->reflection(),
            $this->testFailedMessage(
                $this->mockClassInstanceTestInstance(),
                'reflection',
                'return the expected Reflection'
            )
        );
    }

}

