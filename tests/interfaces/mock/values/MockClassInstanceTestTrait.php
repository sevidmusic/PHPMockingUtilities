<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use \Closure;
use \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance as MockClassInstanceImplementation;
use \Darling\PHPMockingUtilities\interfaces\mock\values\MockClassInstance;
use \Darling\PHPMockingUtilities\tests\PHPMockingUtilitiesTest;
use \Darling\PHPMockingUtilities\tests\interfaces\mock\values\MockClassInstanceTestTrait;
use \Darling\PHPMockingUtilities\tests\mock\abstractions\AbstractImplementationOfInterfaceForClassThatDefinesMethods;
use \Darling\PHPMockingUtilities\tests\mock\classes\AnAttributeClass;
use \Darling\PHPMockingUtilities\tests\mock\classes\ClassThatDoesNotDefineMethods;
use \Darling\PHPMockingUtilities\tests\mock\classes\ImplementationOfInterfaceForClassThatDefinesMethods;
use \Darling\PHPMockingUtilities\tests\mock\classes\TestEnum;
use \Darling\PHPMockingUtilities\tests\mock\classes\TestEnumBacked;
use \Darling\PHPMockingUtilities\tests\mock\interfaces\InterfaceForClassThatDefinesMethods;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection as ReflectionInstance;
use \Darling\PHPReflectionUtilities\interfaces\utilities\Reflection;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPTextTypes\classes\strings\UnknownClass;
use \Darling\PHPTextTypes\interfaces\strings\Name as NameInterface;
use \Darling\PHPTextTypes\interfaces\strings\Text as TextInterface;
use \Fiber;
use \Generator;
use \Reflection as PHPStandardReflection;
use \ReflectionClass;
use \ReflectionClassConstant;
use \ReflectionEnum;
use \ReflectionEnumBackedCase;
use \ReflectionEnumUnitCase;
use \RuntimeException;
use \ReflectionException;
use \ReflectionExtension;
use \ReflectionFiber;
use \ReflectionFunction;
use \ReflectionGenerator;
use \ReflectionIntersectionType;
use \ReflectionMethod;
use \ReflectionNamedType;
use \ReflectionObject;
use \ReflectionParameter;
use \ReflectionProperty;
use \ReflectionReference;
use \ReflectionUnionType;
use \Stringable;
use \stdClass;

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
     *     $randomClassStringOrObjectInstance =
     *         $this->randomClassStringOrObjectInstance();
     *     $classString =
     *         new ClassString(
     *             $randomClassStringOrObjectInstance
     *         );
     *     $expectedReflection = new Reflection($classString);
     *     $this->setExpectedReflection($expectedReflection);
     *     $this->setMockClassInstanceTestInstance(
     *         new MockClassInstance(
     *             $expectedReflection
     *         )
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
     * @example
     *
     * ```
     * $this->setMockClassInstanceTestInstance($mockClassInstance);
     *
     * ```
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
     *     new ClassString(new \stdClass())
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
    public function test_reflection_returns_the_expected_reflection(): void
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

    /**
     * Test that the mockInstance() method returns an instance of
     * a class of the same type as the class or object instance
     * reflected by the expected Reflection, or an instance of a
     * RuntimeException if the class to be mocked defines a private
     * __construct() method.

     * @covers MockClassInstance->mockInstance()
     *
     */
    public function test_mock_instance_returns_an_instance_of_the_same_type_as_the_class_or_object_instance_reflected_by_the_expected_reflection_or_an_instance_of_a_RuntimeException_if_the_class_to_be_mocked_defines_a_private_constructor(): void
    {
        $expectedReflection = $this->expectedReflection()->type()->__toString();
        if(method_exists($expectedReflection, '__construct')) {
            $reflectedConstructor = new  ReflectionMethod($expectedReflection, '__construct');
        }
        match($expectedReflection !== ReflectionReference::class && $expectedReflection !== Closure::class && isset($reflectedConstructor) && $reflectedConstructor->isPrivate()) {
            true =>
                $this->assertEquals(
                    RuntimeException::class,
                    $this->mockClassInstanceTestInstance()
                         ->mockInstance()::class,
                    $this->testFailedMessage(
                        $this->mockClassInstanceTestInstance(),
                        'mockClassInstance',
                        'return an instance a ' .
                        RuntimeException::class .
                        'if the class to be mocked defines a ' .
                        'private __construct() method'
                    )
                ),
            default =>
                $this->assertEquals(
                    $this->expectedReflection()->type()->__toString(),
                    $this->mockClassInstanceTestInstance()
                         ->mockInstance()::class,
                    $this->testFailedMessage(
                        $this->mockClassInstanceTestInstance(),
                        'mockClassInstance',
                        'return an instance of the same type as the ' .
                        'class or object instance reflected by the ' .
                        'expected Reflection'
                    )
                ),
        };
    }

    /**
     * Test that the mockInstance() method returns an instance of
     * a class of the same type as the class or object instance
     * reflected by Reflection returned by the the MockClassInstance's
     * reflection() method, or an instance of a RuntimeException
     * if the class to be mocked defines a private __construct()
     * method.
     *
     * @covers MockClassInstance->mockInstance()
     *
     */
    public function test_mock_instance_returns_an_instance_of_the_same_type_as_the_class_or_object_instance_reflected_by_the_reflection_returned_by_the_mock_class_instances_reflection_method_or_an_instance_of_a_RuntimeException_if_the_class_to_be_mocked_defines_a_private_constructor(): void
    {

        $expectedReflection = $this->expectedReflection()->type()->__toString();
        if(method_exists($expectedReflection, '__construct')) {
            $reflectedConstructor = new  ReflectionMethod($expectedReflection, '__construct');
        }
        match($expectedReflection !== ReflectionReference::class && $expectedReflection !== Closure::class && isset($reflectedConstructor) && $reflectedConstructor->isPrivate()) {
            true =>
                $this->assertEquals(
                    RuntimeException::class,
                    $this->mockClassInstanceTestInstance()
                         ->mockInstance()::class,
                    $this->testFailedMessage(
                        $this->mockClassInstanceTestInstance(),
                        'mockClassInstance',
                        'return an instance a ' .
                        RuntimeException::class .
                        'if the class to be mocked defines a ' .
                        'private __construct() method'
                    )
                ),
            default =>
                $this->assertEquals(
                    $this->mockClassInstanceTestInstance()
                         ->reflection()
                         ->type()
                         ->__toString(),
                     $this->mockClassInstanceTestInstance()
                          ->mockInstance()::class,
                    $this->testFailedMessage(
                        $this->mockClassInstanceTestInstance(),
                        'mockClassInstance',
                        'return an instance of the same type as the ' .
                        'class or object instance reflected by the ' .
                        'MockClassInstance\'s reflection() method'
                    )
                ),
        };
    }

    /**
     * Test that the mockMethodArguments() method returns an array
     * of mock arguments for the specified method of the class
     * or object instance reflected by the Reflection returned by
     * the MockClassInstance's reflection() method.
     *
     * @covers MockClassInstance->mockInstance()
     *
     */
    public function test_mock_method_arguments_returns_an_array_of_mock_arguments_of_the_correct_type_for_the_specified_method_of_the_class_or_object_instance_reflected_by_the_reflection_returned_by_the_mock_class_instances_reflection_method(): void
    {
        match(
            empty(
                $this->mockClassInstanceTestInstance()
                     ->reflection()
                     ->methodNames()
            )
        ) {
            true =>
                $this->assertMockMethodArgumentsReturnsAnEmptyArrayIf(
                    'the class does not define any methods',
                    ''
                ),
            default =>
                $this->assertMockMethodArgumentsReturnsAnAppropriateArrayOfMockArgumentValuesForTheSpecifiedMethod(
                    $this->randomNameOfMethodDefinedByReflectedClass()
                ),
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
        match(
            empty(
                $this->mockClassInstanceTestInstance()
                     ->reflection()
                     ->methodParameterNames($methodName)
            )
        ) {
            true =>
                $this->assertMockMethodArgumentsReturnsAnEmptyArrayIf(
                    'the specified method does not expect any ' .
                    'arguments',
                    $methodName
                ),
                default =>
                    $this->assertMockMethodArgumentsReturnsANonEmptyArrayOfMockArgumentsOfTheCorrectType(
                        $methodName,
                    ),
        };
    }

    /**
     * Assert that mockMethodArguments() returns a non empty array of
     * mock arguments of the correct type.
     *
     * @param string $methodName The name of the method.
     *
     * @example
     *
     * ```
     * $this->assertMockMethodArgumentsReturnsANonEmptyArrayOfMockArgumentsOfTheCorrectType(
     *     $methodName,
     *     $reflectedClassMethodParameterTypes
     * );
     *
     * ```
     *
     */
    private function assertMockMethodArgumentsReturnsANonEmptyArrayOfMockArgumentsOfTheCorrectType(
        string $methodName,
    ): void
    {
        $this->assertRuntimeExceptionIsThrownIfAnyOfTheParametersDefinedByTheSpecifiedMethodExpectAnImplementationOfAnInterfaceOrAnAbstractClass(
            $methodName
        );
        $reflectedClassMethodParameterTypes =
            $this->mockClassInstanceTestInstance()
                 ->reflection()
                 -> methodParameterTypes($methodName);
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
                $reflectedClassMethodParameterTypes[$parameterName]
            );
        }
    }

    /**
     * Assert that a RuntimeException is thrown if any of the
     * parameters defined by the specified method expect an
     * implementation of an interface or an abstract class.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->assertRuntimeExceptionIsThrownIfAnyOfTheParametersDefinedByTheSpecifiedMethodExpectAnImplementationOfAnInterfaceOrAnAbstractClass(
     *     $methodName
     * )
     *
     * ```
     *
     */
    private function assertRuntimeExceptionIsThrownIfAnyOfTheParametersDefinedByTheSpecifiedMethodExpectAnImplementationOfAnInterfaceOrAnAbstractClass(
        string $methodName
    ): void
    {
        $reflectedClassMethodParameterTypes =
            $this->mockClassInstanceTestInstance()
                 ->reflection()
                 -> methodParameterTypes($methodName);
        foreach(
            $reflectedClassMethodParameterTypes as $expectedParameterTypes
        ) {
            foreach(
                $expectedParameterTypes as $expectedParameterType)
            {
                if(
                    interface_exists($expectedParameterType)
                    ||
                    class_exists($expectedParameterType)
                ) {
                    $reflectionClass = new \ReflectionClass(
                        $expectedParameterType
                    );
                    if(
                        $reflectionClass->isInterface()
                        ||
                        $reflectionClass->isAbstract())
                    {
                        if(
                            substr($expectedParameterType, 0, 7)
                            === 'Darling'
                            &&
                            !str_contains(
                                $expectedParameterType,
                                'tests\\'
                            )
                            &&
                            !str_contains(
                                $expectedParameterType,
                                'Tests\\'
                            )
                        ) {
                            continue;
                        }
                        if(
                            $expectedParameterType
                            ===
                            \Stringable::class
                        ) {
                            continue;
                        }
                        $this->expectException(
                            \RuntimeException::class
                        );
                    }
                }
            }
        }
    }

    /**
     * Assert that the specified value's type matches one of the
     * types in the specified array of $expectedMethodParameterTypes.
     *
     * @param mixed $mockArgument The mock argument's value.
     * @param array<int, string> $expectedMethodParameterTypes
     *                                                  An array of
     *                                                  the accepted
     *                                                  types.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->assertMockArgumentsTypeMatchesOneOfTheExpectedTypes(
     *     $mockArgument,
     *     $expectedMethodParameterTypes
     * );
     *
     * ```
     *
     */
    private function assertMockArgumentsTypeMatchesOneOfTheExpectedTypes(
        mixed $mockArgument,
        array $expectedMethodParameterTypes
    ): void
    {
        if(
            is_object($mockArgument)
        ) {
            foreach(
                class_implements($mockArgument) as $implementedType
            ) {
                if(
                    in_array(
                        $implementedType,
                        $expectedMethodParameterTypes
                    )
                ) {
                    $expectedMethodParameterTypes[] =
                        $mockArgument::class;
                }
            }
        }
        if(in_array('mixed', $expectedMethodParameterTypes)) {
            $expectedMethodParameterTypes[] =
                $this->determineType($mockArgument);
        }
        if(in_array('object', $expectedMethodParameterTypes)) {
            $expectedMethodParameterTypes[] =
                \stdClass::class;
        }
        $this->assertTrue(
            in_array(
                $this->determineType($mockArgument),
                $expectedMethodParameterTypes,
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
     * Return a randomly selected name of a method defined by the
     * class or object instance reflected by the Reflection returned
     * by the MockClassInstance's reflection() method.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $this->randomNameOfMethodDefinedByReflectedClass();
     *
     * ```
     *
     */
    private function randomNameOfMethodDefinedByReflectedClass(): string
    {
        $methodNames = $this->mockClassInstanceTestInstance()
                            ->reflection()
                            ->methodNames();
        if(
            empty($methodNames)
            ||
            $this->mockClassInstanceTestInstance()
                 ->reflection()
                 ->type()
                 ->__toString()
             === Closure::class
        ) {
            return '';

        }
        return $methodNames[array_rand($methodNames)];
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
    protected function randomClassStringOrObjectInstance(): string|object
    {
        $reflectedClassWithAttributes = new ReflectionClass(AnAttributeClass::class);
        $attributes = $reflectedClassWithAttributes->getAttributes();
        /** @var array<int, class-string|object> $classes */
        $classes = [
            $this->reflectionReference(),
            ($attributes[0] ?? new ReflectionClass(AnAttributeClass::class)),
            AbstractImplementationOfInterfaceForClassThatDefinesMethods::class,
            ClassThatDoesNotDefineMethods::class,
            ImplementationOfInterfaceForClassThatDefinesMethods::class,
            InterfaceForClassThatDefinesMethods::class,
            Name::class,
            NameInterface::class,
            Text::class,
            TextInterface::class,
            function(): void {},
            new ClassThatDoesNotDefineMethods(),
            new ImplementationOfInterfaceForClassThatDefinesMethods(),
            new Name(new Text($this->randomChars())),
            new PHPStandardReflection(),
            new ReflectionClass(Text::class),
            new ReflectionClass(Text::class),
            new ReflectionClassConstant(MockClassInstanceImplementation::class, 'CONSTRUCT'),
            new ReflectionEnum(TestEnum::class),
            new ReflectionEnumBackedCase(TestEnumBacked::class, 'Bar'),
            new ReflectionEnumUnitCase(TestEnum::class, 'Foo'),
            new ReflectionException(),
            new ReflectionExtension('curl'),
            new ReflectionFiber(new Fiber(function(): string { return 'foo'; })),
            new ReflectionFunction(function(): void {}),
            new ReflectionGenerator($this->intGenerator(PHP_INT_MAX)),
            new ReflectionInstance(new ClassString(Text::class)),
            new ReflectionIntersectionType(),
            new ReflectionMethod(Text::class, '__toString'),
            new ReflectionNamedType(),
            new ReflectionObject(new Text('foo bar baz')),
            new ReflectionParameter([Text::class, '__construct'], 0),
            new ReflectionProperty(Text::class, 'string'),
            new ReflectionProperty(Text::class, 'string'),
            new ReflectionUnionType(),
            new Text($this->randomChars()),
            new stdClass(),
            parent::randomClassStringOrObjectInstance(),
            parent::randomClassStringOrObjectInstance(),
            stdClass::class,
        ];
        return (
            empty($classes)
            ? new stdClass()
            : $classes[array_rand($classes)]
        );
    }

    private function intGenerator(int $max): Generator {
        for ($i = 1; $i <= $max; $i++) {
            yield $i;
        }
    }

    private function reflectionReference(): ReflectionReference|ClassString
    {
        $referencedValue = 'value';
        $reflectionReference = ReflectionReference::fromArrayElement(
            [&$referencedValue],
            0
        );
        return $reflectionReference ?? new ClassString(ReflectionReference::class);
    }
}

