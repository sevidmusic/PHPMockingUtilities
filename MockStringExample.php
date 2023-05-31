<?php

/**
 * This file provides examples that demonstrate how to use a MockString.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockString;

$mockString = new MockString();

var_dump($mockString->value());

