<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockValue;

/**
 * The MockValueTestTrait defines common tests for
 * implementations of the MockValue interface.
 *
 * @see MockValue
 *
 */
trait MockValueTestTrait
{

    /**
     * @var MockValue $mockValue
     *                              An instance of a
     *                              MockValue
     *                              implementation to test.
     */
    protected MockValue $mockValue;

    /**
     * Return the MockValue implementation instance to test.
     *
     * @return MockValue
     *
     */
    protected function mockValueTestInstance(): MockValue
    {
        return $this->mockValue;
    }

    /**
     * Set the MockValue implementation instance to test.
     *
     * @param MockValue $mockValueTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the MockValue
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setMockValueTestInstance(
        MockValue $mockValueTestInstance
    ): void
    {
        $this->mockValue = $mockValueTestInstance;
    }

    /**
     * Set up an instance of a MockValue implementation to test.
     *
     * This method must also set the MockValue implementation instance
     * to be tested via the setMockValueTestInstance() method.
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
     *     $this->setMockValueTestInstance(
     *         new \Darling\PHPMockingUtilities\classes\mock\values\MockValue()
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
     * @covers MockValue::value()
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

