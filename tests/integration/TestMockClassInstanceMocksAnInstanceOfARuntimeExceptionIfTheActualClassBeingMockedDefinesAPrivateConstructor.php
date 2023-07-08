<?php

require(
    str_replace(
        'tests' . DIRECTORY_SEPARATOR . 'integration',
        'vendor',
        __DIR__,
    ) . DIRECTORY_SEPARATOR . 'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance;
use \Darling\PHPMockingUtilities\tests\mock\classes\ClassThatDefinesAPrivateConstructor;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection as DarlingReflection;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Text;

$instance = ClassThatDefinesAPrivateConstructor::class;
$mi = new MockClassInstance(
    new DarlingReflection(new ClassString($instance))
);

echo "\033[38;5;0m\033[48;5;111mRunning test" . __FILE__ . " \033[48;5;0m";

$expectedErrorMessage =
    'The ' .
    $instance .
    ' class defines a private ' .
    '__construct' .
    ' method. '  .
    'It is not possible to mock an instance of a ' .
    'class that defines a private ' .
    '__construct' .
    ' method';
if(
    $mi->mockInstance()::class === RuntimeException::class
    &&
    $mi->mockInstance()->getMessage() === $expectedErrorMessage
) {
    echo "\033[38;5;0m\033[48;5;84mPassed\033[48;5;0m";
} else {
    echo "\033[38;5;0m\033[48;5;196mFailed\033[48;5;0m";
}

