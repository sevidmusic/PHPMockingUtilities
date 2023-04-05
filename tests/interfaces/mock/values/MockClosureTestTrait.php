<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockClosure;

/**
 * The MockClosureTestTrait defines common tests for implementations
 * of the MockClosure interface.
 *
 * @see MockClosure
 *
 */
trait MockClosureTestTrait
{

    /**
     * @var MockClosure $mockClosure An instance of a MockClosure
     *                               implementation to test.
     */
    protected MockClosure $mockClosure;

    /**
     * Set up an instance of a MockClosure implementation to test.
     *
     * This method must also set the MockClosure implementation instance
     * to be tested via the setMockClosureTestInstance() method.
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
     *     $this->setMockClosureTestInstance(
     *         new \Darling\PHPMockingUtilities\classes\mock\values\MockClosure()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the MockClosure implementation instance to test.
     *
     * @return MockClosure
     *
     */
    protected function mockClosureTestInstance(): MockClosure
    {
        return $this->mockClosure;
    }

    /**
     * Set the MockClosure implementation instance to test.
     *
     * @param MockClosure $mockClosureTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the MockClosure
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setMockClosureTestInstance(
        MockClosure $mockClosureTestInstance
    ): void
    {
        $this->mockClosure = $mockClosureTestInstance;
    }

    /**
     * Test that value() always returns the same closure.
     *
     * @covers MockInt->value()
     *
     */
    public function testValueAlwaysReturnsTheSameInteger(): void
    {
        $this->assertEquals(
            $this->mockClosureTestInstance()->value(),
            $this->mockClosureTestInstance()->value(),
            $this->testFailedMessage(
                $this->mockClosureTestInstance(),
                'value',
                'always return the same closure'
            ),
        );
    }
}

