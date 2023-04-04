<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockInt;

/**
 * The MockIntTestTrait defines common tests for
 * implementations of the MockInt interface.
 *
 * @see MockInt
 *
 */
trait MockIntTestTrait
{

    /**
     * @var MockInt $mockInt An instance of a MockInt implementation
     *                       to test.
     */
    protected MockInt $mockInt;

    /**
     * Set up an instance of a MockInt implementation to test.
     *
     * This method must also set the MockInt implementation instance
     * to be tested via the setMockIntTestInstance() method.
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
     *     $this->setMockIntTestInstance(
     *         new \Darling\PHPMockingUtilities\classes\mock\values\MockInt()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the MockInt implementation instance to test.
     *
     * @return MockInt
     *
     */
    protected function mockIntTestInstance(): MockInt
    {
        return $this->mockInt;
    }

    /**
     * Set the MockInt implementation instance to test.
     *
     * @param MockInt $mockIntTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the MockInt
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setMockIntTestInstance(
        MockInt $mockIntTestInstance
    ): void
    {
        $this->mockInt = $mockIntTestInstance;
    }

    /**
     * Test that value() always returns the same integer.
     *
     * @covers MockInt->value()
     *
     */
    public function testValueAlwaysReturnsTheSameInteger(): void
    {
        $this->assertEquals(
            $this->mockIntTestInstance()->value(),
            $this->mockIntTestInstance()->value(),
            $this->testFailedMessage(
                $this->mockIntTestInstance(),
                'value',
                'always return the same integer'
            ),
        );
    }
}

