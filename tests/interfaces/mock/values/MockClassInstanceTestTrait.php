<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockClassInstance;
use \Darling\PHPReflectionUtilities\interfaces\utilities\Reflection;
use \ReflectionClass;

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
     * expected to be assigned to the MockClassInstance being tested
     * via the setExpectedReflection() method.
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
     * Set the Reflection instance that is expected to be assigned
     * to the MockClassInstance being tested.
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
     * assigned to the MockClassInstance being tested.
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
        $methodNames = $this->mockClassInstanceTestInstance()
                            ->reflection()
                            ->methodNames();
        if(empty($methodNames)) {
            $this->assertEmpty(
                $this->mockClassInstanceTestInstance()->mockMethodArguments(''),
                $this->testFailedMessage(
                    $this->mockClassInstanceTestInstance(),
                    'mockMethodArguments',
                    'return an empty array if the class does not ' .
                    'define any methods'
                )
            );
        }
        if(!empty($methodNames)) {
            $methodName = $methodNames[array_rand($methodNames)];
            $expectedArgumentTypes =
                $this->mockClassInstanceTestInstance()
                     ->reflection()
                     ->methodParameterTypes($methodName);
            if(empty($expectedArgumentTypes)) {
                $this->assertEmpty(
                    $this->mockClassInstanceTestInstance()->mockMethodArguments($methodName),
                    $this->testFailedMessage(
                        $this->mockClassInstanceTestInstance(),
                        'mockMethodArguments',
                        'return an empty array if the specified ' .
                        'method does not expect any arguments'
                    )
                );
            }
            $mockArguments = $this->mockClassInstanceTestInstance()->mockMethodArguments($methodName);
            if(
                !empty($expectedArgumentTypes)
                &&
                empty($mockArguments)
            ) {
                $this->assertNotEmpty(
                    $mockArguments,
                    $this->testFailedMessage(
                        $this->mockClassInstanceTestInstance(),
                        'mockMethodArguments',
                        'return an non-empty array if the ' .
                        'specified method expects arguments'
                    )
                );
            }
            if(!empty($expectedArgumentTypes)) {
                foreach(
                   $mockArguments
                     as
                     $name => $mockArgument
                ) {
                    $type = (
                        is_object($mockArgument)
                        ? $mockArgument::class
                        : str_replace(
                            [
                                'integer',
                                'boolean',
                            ],
                            [
                                'int',
                                'bool',
                            ],
                            gettype($mockArgument))
                    );
                    $this->assertTrue(
                        in_array($type, $expectedArgumentTypes[$name], true),
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
            }
        }

    }
}

