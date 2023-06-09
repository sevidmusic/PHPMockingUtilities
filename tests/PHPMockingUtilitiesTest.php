<?php

namespace Darling\PHPMockingUtilities\tests;

use Darling\PHPUnitTestUtilities\traits\PHPUnitConfigurationTests;
use Darling\PHPUnitTestUtilities\traits\PHPUnitRandomValues;
use Darling\PHPUnitTestUtilities\traits\PHPUnitTestMessages;
use PHPUnit\Framework\TestCase;

/**
 * Defines common methods that may be useful to all
 * PHPMockingUtilities test classes.
 *
 * All PHPMockingUtilities test classes must extend from this class.
 *
 */
class PHPMockingUtilitiesTest extends TestCase
{
    use PHPUnitConfigurationTests;
    use PHPUnitRandomValues;
    use PHPUnitTestMessages;
}
