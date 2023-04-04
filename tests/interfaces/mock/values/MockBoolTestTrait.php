<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockBool;

/**
 * The MockBoolTestTrait defines common tests for
 * implementations of the MockBool interface.
 *
 * @see MockBool
 *
 */
trait MockBoolTestTrait
{

    /**
     * @var MockBool $mockBool
     *                              An instance of a
     *                              MockBool
     *                              implementation to test.
     */
    protected MockBool $mockBool;

    /**
     * Set up an instance of a MockBool implementation to test.
     *
     * This method must also set the MockBool implementation instance
     * to be tested via the setMockBoolTestInstance() method.
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
     *     $this->setMockBoolTestInstance(
     *         new \Darling\PHPMockingUtilities\classes\mock\values\MockBool()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the MockBool implementation instance to test.
     *
     * @return MockBool
     *
     */
    protected function mockBoolTestInstance(): MockBool
    {
        return $this->mockBool;
    }

    /**
     * Set the MockBool implementation instance to test.
     *
     * @param MockBool $mockBoolTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the MockBool
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setMockBoolTestInstance(
        MockBool $mockBoolTestInstance
    ): void
    {
        $this->mockBool = $mockBoolTestInstance;
    }

    /**
     * Test that the value() method always returns false.
     *
     * @return void
     *
     * @covers MockBool->value()
     *
     */
    public function testValueReturnsFalse(): void
    {
        $this->assertFalse(
            $this->mockBoolTestInstance()->value(),
            $this->testFailedMessage(
                $this->mockBoolTestInstance(),
                'value',
                'return false'
            )
        );
    }
}

