<?php

/**
 * This file provides an example that demonstrate how to use a
 * MockClassInstance.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection;


$mockClassInstance = new MockClassInstance(
    new Reflection(new ClassString(Id::class))
);

var_dump($mockClassInstance->mockInstance());

