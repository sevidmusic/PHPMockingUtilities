<?php

namespace Darling\PHPMockingUtilities\tests\interfaces\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockString;
use Darling\PHPTextTypes\Tests\interfaces\strings\TextTestTrait;

/**
 * The MockStringTestTrait defines common tests for implementations
 * of the MockString interface.
 *
 * @see MockString
 *
 */
trait MockStringTestTrait
{

    use TextTestTrait;

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
     * This method must set the MockString implementation instance
     * to be tested via the setMockStringTestInstance() method.
     *
     * This method must also set the MockString as the
     * Text implementation instance to be tested via the
     * setTextTestInstance() method.
     *
     * This method must also set the expected string via the
     * setExpectedString() method.
     *
     * This method may also be used to perform any additional setup
     * required by the implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * public function setUp(): void
     * {
     *     $mockString = new MockString();
     *     $this->setMockStringTestInstance($mockString);
     *     $this->setExpectedString($mockString->__toString());
     *     $this->setTextTestInstance($mockString);
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

    /**
     * Test that the value() method always returns the same string.
     *
     * @covers MockString->value()
     *
     */
    public function testValueAlwaysReturnsTheSameString(): void
    {
        $this->assertEquals(
            $this->mockStringTestInstance()->value(),
            $this->mockStringTestInstance()->value(),
            $this->testFailedMessage(
                $this->mockStringTestInstance(),
                'value',
                'always return the same string'
            ),
        );
    }


    /**
     * Test that the value() method does not return an empty string.
     *
     * @covers MockString->value()
     *
     */
    public function testValueReturnsANonEmptyString(): void
    {
        $this->assertNotEmpty(
            $this->mockStringTestInstance()->value(),
            $this->testFailedMessage(
                $this->mockStringTestInstance(),
                'value',
                'return a non-empty string'
            ),
        );
    }

    /**
     * Test that the value() method returns a string whose length is
     * less than 50.
     *
     * @covers MockString->value()
     *
     */
    public function testValueReturnsAStringWhoseLengthIsLessThan50(): void
    {
        $this->assertTrue(
            50 > $this->mockStringTestInstance()->length(),
            $this->testFailedMessage(
                $this->mockStringTestInstance(),
                'value',
                'return a string whose length is less than 50'
            ),
        );
    }

    /**
     * Test that the value() method returns a string whose length is
     * greater than 40.
     *
     * @covers MockString->value()
     *
     */
    public function testValueReturnsAStringWhoseLengthIsGreaterThan40(): void
    {
        $this->assertTrue(
            40 < $this->mockStringTestInstance()->length(),
            $this->testFailedMessage(
                $this->mockStringTestInstance(),
                'value',
                'return a string whose length is greater than 40'
            ),
        );
    }

    /**
     * Test that value method returns a string that begins with the
     * string "MockString".
     *
     * @covers MockString->value()
     *
     */
    public function testValueReturnsAStringThatBeginsWithTheString_MockString(): void
    {
        $this->assertEquals(
            'MockString',
            substr($this->mockStringTestInstance(), 0, 10),
            $this->testFailedMessage(
                $this->mockStringTestInstance(),
                'value',
                'return a string that begins with the ' .
                'string "MockString"',
            ),
        );
    }
}

