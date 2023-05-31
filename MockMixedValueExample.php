<?php

/**
 * This file provides examples that demonstrate how to use a MockMixedValue.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue;

$mockMixedValue = new MockMixedValue();

var_dump($mockMixedValue->value());

