<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockArray;

/**
 * The MockArrayTestTrait defines common tests for implementations
 * of the MockArray interface.
 *
 * @see MockArray
 *
 */
trait MockArrayTestTrait
{

    /**
     * @var MockArray $mockArray An instance of a MockArray
     *                           implementation to test.
     */
    protected MockArray $mockArray;

    /**
     * Set up an instance of a MockArray implementation to test.
     *
     * This method must also set the MockArray implementation instance
     * to be tested via the setMockArrayTestInstance() method.
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
     *     $this->setMockArrayTestInstance(
     *         new \Darling\PHPMockingUtilities\classes\mock\values\MockArray()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the MockArray implementation instance to test.
     *
     * @return MockArray
     *
     */
    protected function mockArrayTestInstance(): MockArray
    {
        return $this->mockArray;
    }

    /**
     * Set the MockArray implementation instance to test.
     *
     * @param MockArray $mockArrayTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the MockArray
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setMockArrayTestInstance(
        MockArray $mockArrayTestInstance
    ): void
    {
        $this->mockArray = $mockArrayTestInstance;
    }

    /**
     * Test the value() returns an empty array.
     *
     * @covers MockArray->value()
     *
     */
    public function testValueReturnsAnEmptyArray(): void
    {
        $this->assertEmpty(
            $this->mockArrayTestInstance()->value(),
            $this->testFailedMessage(
                $this->mockArrayTestInstance(),
                'value',
                'return an empty array'
            )
        );
    }

}

