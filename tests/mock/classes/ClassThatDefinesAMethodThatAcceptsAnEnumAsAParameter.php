<?php

namespace Darling\PHPMockingUtilities\tests\mock\classes;

use \Darling\PHPMockingUtilities\tests\mock\classes\TestEnum;
use \Darling\PHPMockingUtilities\tests\mock\classes\TestEnumBacked;

/**
 * The following class is defined here for use by the
 * MockClassInstanceTest
 *
 */
class ClassThatDefinesAMethodThatAcceptsAnEnumAsAParameter
{

    public function __construct(
        public readonly TestEnum $testEnum,
        public readonly TestEnumBacked $testBackedEnum,
    ) {
    }

}
