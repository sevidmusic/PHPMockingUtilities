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

    private Reflection $expectedReflection;

    /**
     * @var MockClassInstance $mockClassInstance
     *                              An instance of a
     *                              MockClassInstance
     *                              implementation to test.
     */
    protected MockClassInstance $mockClassInstance;

    /**
     * Set up an instance of a MockClassInstance implementation to test.
     *
     * This method must set the MockClassInstance implementation instance
     * to be tested via the setMockClassInstanceTestInstance() method.
     *
     * This method must also set the expected Reflection instance
     * to via the setExpectedReflection() method.
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
     *         new ReflectionClass(new \stdClass()) # todo: use random class instance
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

    protected function setExpectedReflection(Reflection $reflection): void
    {
        $this->expectedReflection = $reflection;
    }

    protected function expectedReflection(): Reflection
    {
        return $this->expectedReflection;
    }

    /**
     * Test that the reflection method returns the expected Reflection.
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

}

