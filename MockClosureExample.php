<?php

/**
 * This file provides examples that demonstrate how to use a MockClosure.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockClosure;

$mockClosure = new MockClosure();

var_dump($mockClosure->value());

