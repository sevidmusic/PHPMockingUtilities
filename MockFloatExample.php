<?php

/**
 * This file provides an example that demonstrate how to use a
 * MockFloat.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockFloat;

$mockFloat = new MockFloat();

var_dump($mockFloat->value());

