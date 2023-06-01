<?php

/**
 * This file provides an example that demonstrate how to use a
 * MockBool.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockBool;

$mockBool = new MockBool();

var_dump($mockBool->value());

