<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockFloat;

/**
 * The MockFloatTestTrait defines common tests for implementations
 * of the MockFloat interface.
 *
 * @see MockFloat
 *
 */
trait MockFloatTestTrait
{

    /**
     * @var MockFloat $mockFloat An instance of a MockFloat
     *                           implementation to test.
     */
    protected MockFloat $mockFloat;

    /**
     * Set up an instance of a MockFloat implementation to test.
     *
     * This method must also set the MockFloat implementation instance
     * to be tested via the setMockFloatTestInstance() method.
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
     *     $this->setMockFloatTestInstance(
     *         new \Darling\PHPMockingUtilities\classes\mock\values\MockFloat()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the MockFloat implementation instance to test.
     *
     * @return MockFloat
     *
     */
    protected function mockFloatTestInstance(): MockFloat
    {
        return $this->mockFloat;
    }

    /**
     * Set the MockFloat implementation instance to test.
     *
     * @param MockFloat $mockFloatTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the MockFloat
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setMockFloatTestInstance(
        MockFloat $mockFloatTestInstance
    ): void
    {
        $this->mockFloat = $mockFloatTestInstance;
    }


    /**
     * Test that value() returns a float that is greater than PHP_FLOAT_MIN.
     *
     * @covers MockFloat->value()
     *
     */
    public function testValueReturnsAFloatThatIsGreaterThanPHP_FLOAT_MIN(): void
    {
        $this->assertGreaterThan(
            PHP_FLOAT_MIN,
            $this->mockFloatTestInstance()->value(),
            $this->testFailedMessage(
                $this->mockFloatTestInstance(),
                'value',
                'return a float that is greater than PHP_FLOAT_MIN'
            )
        );
    }

    /**
     * Test that value() returns a float that is less than PHP_FLOAT_MAX.
     *
     * @covers MockFloat->value()
     *
     */
    public function testValueReturnsAFloatThatIsLessThanPHP_FLOAT_MAX(): void
    {
        $this->assertLessThan(
            PHP_FLOAT_MAX,
            $this->mockFloatTestInstance()->value(),
            $this->testFailedMessage(
                $this->mockFloatTestInstance(),
                'value',
                'return a float that is less than PHP_FLOAT_MAX'
            )
        );
    }

    /**
     * Test that value() returns a float that is not equal to zero.
     *
     * @covers MockFloat->value()
     *
     */
    public function testValueReturnsAFloatThatIsNotEqualToZero(): void
    {
        $this->assertNotEquals(
            0,
            $this->mockFloatTestInstance()->value(),
            $this->testFailedMessage(
                $this->mockFloatTestInstance(),
                'value',
                'return a float that is not equal to 0'
            )
        );
    }

    /**
     * Test that value() always returns the same float.
     *
     * @covers MockInt->value()
     *
     */
    public function testValueAlwaysReturnsTheSameInteger(): void
    {
        $this->assertEquals(
            $this->mockFloatTestInstance()->value(),
            $this->mockFloatTestInstance()->value(),
            $this->testFailedMessage(
                $this->mockFloatTestInstance(),
                'value',
                'always return the same float'
            ),
        );
    }

}

