<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockMixedValue;

/**
 * The MockMixedValueTestTrait defines common tests for
 * implementations of the MockMixedValue interface.
 *
 * @see MockMixedValue
 *
 */
trait MockMixedValueTestTrait
{

    /**
     * @var MockMixedValue $mockValue
     *                              An instance of a
     *                              MockMixedValue
     *                              implementation to test.
     */
    protected MockMixedValue $mockValue;

    /**
     * Return the MockMixedValue implementation instance to test.
     *
     * @return MockMixedValue
     *
     */
    protected function mockValueTestInstance(): MockMixedValue
    {
        return $this->mockValue;
    }

    /**
     * Set the MockMixedValue implementation instance to test.
     *
     * @param MockMixedValue $mockValueTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the MockMixedValue
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setMockMixedValueTestInstance(
        MockMixedValue $mockValueTestInstance
    ): void
    {
        $this->mockValue = $mockValueTestInstance;
    }

    /**
     * Set up an instance of a MockMixedValue implementation to test.
     *
     * This method must also set the MockMixedValue implementation instance
     * to be tested via the setMockMixedValueTestInstance() method.
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
     *     $this->setMockMixedValueTestInstance(
     *         new \Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;


    /**
     * Test that the value() method always returns the same value.
     *
     * @return void
     *
     * @covers MockMixedValue::value()
     */
    public function testValueReturnsTheSameValueWhenCalledMoreThanOnce(): void
    {
        $this->assertEquals(
            $this->mockValueTestInstance()->value(),
            $this->mockValueTestInstance()->value(),
            $this->testFailedMessage(
                $this->mockValueTestInstance(),
                'value',
                'return the same value when called more than once'
            )
        );
    }
}

