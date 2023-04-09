<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use \Darling\PHPMockingUtilities\interfaces\mock\values\MockClassInstance;
use \Darling\PHPReflectionUtilities\interfaces\utilities\Reflection;
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
                'value',
                'return the expected Reflection'
            )
        );
    }

    /**
     * Test that the mockInstance() method returns an instance of
     * a class of the same type as the class or object instance
     * reflected by the MockClassInstance's Reflection.
     *
     * @covers MockClassInstance->mockInstance()
     *
     */
    public function testMockInstanceReturnsAnInstanceOfTheSameTypeAsTheClassOrObjectInstanceReflectedByTheReflectionAssignedToTheMockClassInstance(): void
    {
        $this->assertEquals(
            $this->mockClassInstanceTestInstance()->reflection()->type()->__toString(),
            $this->mockClassInstanceTestInstance()->mockInstance()::class,
            $this->testFailedMessage(
                $this->mockClassInstanceTestInstance(),
                'mockClassInstance',
                'return an instance of the same type as the ' .
                'class or object instance reflected by the Reflection'
            )
        );
    }

    /**
     * Test that the mockMethodArguments() method returns an array
     * of mock arguments for the specified method of the class
     * or object instance reflected by the Reflection assigned
     * to the MockClassInstance.
     *
     * @covers MockClassInstance->mockInstance()
     *
     */
    public function testMockMethodArgumentsReturnsAnArrayOfMockArgumentsOfTheCorrectTypeForTheSpecifiedMethodOfTheClassOrObjectInstanceReflectedByTheReflectionAssignedToTheMockClassInstance(): void
    {
        $methodNames = $this->expectedMethodNames();
        match(empty($methodNames)) {
            true =>
                $this->assertMockMethodArgumentsReturnsAnEmptyArrayIf(
                    'the class does not define any methods',
                    ''
                ),
            default => $this->assertMockMethodArgumentsReturnsAnAppropriateArrayOfMockArgumentValuesForTheSpecifiedMethod(
                    $this->randomMethodName()
                )
        };

    }

    /**
     * Assert that mockMethodArguments() returns an appropriate array
     * of mock arguments for the specified method of the class or
     * object instance reflected by the Reflection assigned to the
     * MockClassInstance being tested..
     *
     * If the method does not define any parameters this method will
     * assert that mockMethodArguments() returns an empty array.
     *
     * If the method does define parameters, then this method will
     * assert that mockMethodArguments() returns an array of
     * mock argument of the appropriate type.
     *
     * @param string $methodName The name of the method.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->assertMockMethodArgumentsReturnsAnAppropriateArrayOfMockArgumentValuesForTheSpecifiedMethod()
     *
     * ```
     *
     */
    private function assertMockMethodArgumentsReturnsAnAppropriateArrayOfMockArgumentValuesForTheSpecifiedMethod(
        string $methodName
    ): void
    {
        if(
            !method_exists(
                $this->mockClassInstanceTestInstance()
                     ->reflection()
                     ->type()
                     ->__toString(),
                 $methodName
            )
        ) {
            $this->expectException(\ReflectionException::class);
        }
        $expectedArgumentTypes = $this->expectedArgumentTypes(
            $methodName
        );
        match(empty($expectedArgumentTypes)) {
            true =>
                $this->assertMockMethodArgumentsReturnsAnEmptyArrayIf(
                    'the specified method does not expect any ' .
                    'arguments',
                    $methodName
                ),
                default =>
                    $this->assertMockMethodArgumentsReturnsAnArrayOfMockArgumentsOfTheCorrectType(
                    $methodName,
                    $expectedArgumentTypes
                ),
        };
    }

    /**
     * Assert that mockMethodArguments() returns a non empty array of
     * mock arguments of the correct type.
     *
     * @param string $methodName The name of the method.
     *
     * @param array<string, array<int, string>> $expectedArgumentTypes
     *                                          An array of the
     *                                          method's expected
     *                                          argument types.
     *
     * @example
     *
     * ```
     * $this->assertMockMethodArgumentsReturnsAnArrayOfMockArgumentsOfTheCorrectType(
     *     $methodName,
     *     $expectedArgumentTypes
     * ),
     *
     * ```
     *
     */
    private function assertMockMethodArgumentsReturnsAnArrayOfMockArgumentsOfTheCorrectType(
        string $methodName,
        array $expectedArgumentTypes
    ): void
    {
        foreach($expectedArgumentTypes as $argumentName => $acceptedTypes) {
            foreach($acceptedTypes as $acceptedType) {
                if(class_exists($acceptedType)) {
                    $reflectionClass = new \ReflectionClass(
                        $acceptedType
                    );
                    if(
                        $reflectionClass->isInterface()
                        ||
                        $reflectionClass->isAbstract()
                    ) {
                        $this->expectException(\RuntimeException::class);
                    }
                }
            }
        }
        $mockArguments = $this->mockClassInstanceTestInstance()
                              ->mockMethodArguments($methodName);
        $this->assertNotEmpty(
            $mockArguments,
            $this->testFailedMessage(
                $this->mockClassInstanceTestInstance(),
                'mockMethodArguments',
                'return an non-empty array if the ' .
                'specified method expects arguments'
            )
        );
        foreach(
           $mockArguments
             as
             $parameterName => $mockArgument
        ) {
            $this->assertMockArgumentsTypeMatchesOneOfTheExpectedTypes(
                $mockArgument,
                $expectedArgumentTypes[$parameterName]
            );
        }
    }

    /**
     * Assert that the specified value's type matches one of the
     * types in the specified array of $expectedArgumentTypes.
     *
     * @param mixed $mockArgument The mock argument's value.
     * @param array<int, string> $expectedArgumentTypes An array of
     *                                                  the accepted
     *                                                  types.
     *
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->assertMockArgumentsTypeMatchesOneOfTheExpectedTypes(
     *     $mockArgument,
     *     $expectedArgumentTypes
     * );
     *
     * ```
     *
     */
    private function assertMockArgumentsTypeMatchesOneOfTheExpectedTypes(
        mixed $mockArgument,
        array $expectedArgumentTypes
    ): void
    {
        /**
         * If the parameter is an object, determine if any
         * of the types it implements are one of the
         * $expectedArgumentTypes.
         *
         * This prevents a false positive in the tests that was
         * occuring when parameters that accept an implementation
         * of an interface or abstract class were targeted during
         * testing.
         *
         * This allows mocking arguents for a method like:
         *
         * ```
         * public function f(\Some\Interface $accetedImplementations)
         * {
         *     // ...
         * }
         *
         * ```
         *
         */
        if(
            is_object($mockArgument)
        ) {
            foreach(class_implements($mockArgument) as $implementedType) {
                if(
                    in_array(
                        $implementedType,
                        $expectedArgumentTypes
                    )
                ) {
                    array_push($expectedArgumentTypes, $mockArgument::class);
                }
            }
        }

        /**
         * If parameter accepts 'mixed' add the $mockArgument's
         * determined type to the array of $expectedArgumentTypes
         * since the $expectedArgumentTypes array may contain the
         * 'mixed' type but may not contain the $mockArgument's
         * actual type even though any type is valid.
         *
         * This prevents a false positive in the tests that was
         * occuring when parameters that accept 'mixed' were
         * targeted during testing.
         *
         */
        if(in_array('mixed', $expectedArgumentTypes)) {
            array_push($expectedArgumentTypes, $this->determineType($mockArgument));
        }
        /**
         * If parameter accepts 'object' add stdClass::class to
         * the array of $expectedArgumentTypes since the
         * $expectedArgumentTypes array may contain the
         * 'object' type but may not contain stdClass::class
         * even though stdClass::class is valid if the
         * parameter's accpeted types includes 'object'.
         *
         * This prevents a false positive in the tests that was
         * occuring when parameters that accept 'mixed' were
         * targeted
         */
        if(in_array('object', $expectedArgumentTypes)) {
            array_push($expectedArgumentTypes, \stdClass::class);
        }
        $this->assertTrue(
            in_array(
                $this->determineType($mockArgument),
                $expectedArgumentTypes,
                true
            ),
            $this->testFailedMessage(
                $this->mockClassInstanceTestInstance(),
                'mockMethodArguments',
                'return an array of mock arguments of ' .
                'the correct type for the specified ' .
                'method of the class or object ' .
                'instance reflected by the ' .
                'Reflection assigned to the ' .
                'MockClassInstance'
            )
        );
    }

    /**
     * Assert that the mockMethodArguments() method returns an
     * empty array for the specified $reason.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->assertMockMethodArgumentsReturnsAnEmptyArrayIf(
     *     'reason mockMethodArguments() should return an empty array',
     *     'methodName'
     * );
     *
     * ```
     *
     */
    private function assertMockMethodArgumentsReturnsAnEmptyArrayIf(
        string $reason,
        string $methodName
    ): void
    {
        $this->assertEmpty(
            $this->mockClassInstanceTestInstance()
                 ->mockMethodArguments($methodName),
            $this->testFailedMessage(
                $this->mockClassInstanceTestInstance(),
                'mockMethodArguments',
                'return an empty array if ' . $reason
            )
        );
    }

    /**
     * Determine the type of the specified value.
     *
     * @return string
     *
     * @example
     *
     * ```
     * var_dump(determineType(mixed $value));
     *
     * // example output:
     * string(3) "int"
     *
     * ```
     *
     */
    private function determineType(mixed $value): string
    {
        /**
         * String replacements are to insure consistency.
         *
         * For example:
         *
         * gettype() will return the string 'double' for a float.
         *
         * Hpwever, Reflection->methodParameterTypes() uses the
         * string 'float' to indicate a float, so to insure there
         * are not false positives that trigger a failing test,
         * we need to insure determineType() returns a string that
         * will match one of the strings used to indicate type in
         * the array returned by Reflection->methodParameterTypes().
         */
        return
            is_object($value)
            ? $value::class
            : str_replace(
                [ 'integer', 'boolean', 'double'],
                [ 'int', 'bool', 'float'],
                gettype($value)
        );
    }

    /**
     * Returns an associatively indexed array of numerically
     * indexed arrays of strings indicating the types accepted
     * by the parameters expected by the specified method of the
     * class or object instance reflected by the Reflection assigned
     * to the MockClassInstance being tested.
     *
     * The arrays of strings indicating the types accepted by each
     * parameter will be indexed by the name of the parameter they
     * are associated with.
     *
     * @param string $methodName The name of method.
     *
     * @return array<string, array<int, string>>
     *
     * @example
     *
     * ```
     * var_dump($reflection->type()->__toString());
     *
     * // example output:
     * string(59) "Darling\PHPReflectionUtilities\classes\utilities\Reflection"
     *
     * var_dump($reflection->methodParameterTypes('methodParameterTypes'));
     *
     * // example output:
     * array(1) {
     *   ["method"]=>
     *   array(1) {
     *     [0]=>
     *     string(6) "string"
     *   }
     * }
     *
     * ```
     */
    private function expectedArgumentTypes($methodName): array
    {
        return $this->mockClassInstanceTestInstance()
                    ->reflection()
                    ->methodParameterTypes($methodName);
    }

    /**
     * Return a randomly selected name of a method defined by the
     * class or object instance reflected by the Reflection assigned
     * to the MockClassInstance being tested.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $this->randomMethodName();
     *
     * ```
     *
     */
    private function randomMethodName(): string
    {
        $methodNames = $this->expectedMethodNames();
        if(!empty($methodNames)) {
            return $methodNames[array_rand($methodNames)];
        }
        return '';
    }

    /**
     * Return a numerically indexed array of the names of the
     * methods defined by the class or object instance reflected
     * by the Reflection assigned to the MockClassInstance being
     * tested.
     *
     * @return array<int, string>
     *
     * @example
     *
     * ```
     * $reflection = ;
     * var_dump(
     *     $this->mockClassInstance()
     *          ->reflection()
     *          ->type()
     *          ->__toString(),
     * );
     *
     * // example output:
     * string(59) "Darling\PHPReflectionUtilities\classes\utilities\Reflection"
     *
     * var_dump($this->methodNames());
     *
     * // example output:
     * array(7) {
     *   [0]=>
     *   string(11) "__construct"
     *   [1]=>
     *   string(11) "methodNames"
     *   [2]=>
     *   string(20) "methodParameterNames"
     *   [3]=>
     *   string(20) "methodParameterTypes"
     *   [4]=>
     *   string(13) "propertyNames"
     *   [5]=>
     *   string(13) "propertyTypes"
     *   [6]=>
     *   string(4) "type"
     * }
     *
     * ```
     *
     */
    public function expectedMethodNames(): array
    {
        return $this->mockClassInstanceTestInstance()
             ->reflection()
             ->methodNames();
    }
}

