<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockString;

/**
 * The MockStringTestTrait defines common tests for
 * implementations of the MockString interface.
 *
 * @see MockString
 *
 */
trait MockStringTestTrait
{

    /**
     * @var MockString $mockString
     *                              An instance of a
     *                              MockString
     *                              implementation to test.
     */
    protected MockString $mockString;

    /**
     * Set up an instance of a MockString implementation to test.
     *
     * This method must also set the MockString implementation instance
     * to be tested via the setMockStringTestInstance() method.
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
     *     $this->setMockStringTestInstance(
     *         new \Darling\PHPMockingUtilities\classes\mock\values\MockString()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the MockString implementation instance to test.
     *
     * @return MockString
     *
     */
    protected function mockStringTestInstance(): MockString
    {
        return $this->mockString;
    }

    /**
     * Set the MockString implementation instance to test.
     *
     * @param MockString $mockStringTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the MockString
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setMockStringTestInstance(
        MockString $mockStringTestInstance
    ): void
    {
        $this->mockString = $mockStringTestInstance;
    }

}

