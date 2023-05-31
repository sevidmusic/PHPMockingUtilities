<?php

/**
 * This file provides examples that demonstrate how to use a MockInt.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockInt;

$mockInt = new MockInt();

var_dump($mockInt->value());

