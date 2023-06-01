<?php

/**
 * This file provides an example that demonstrate how to use a
 * MockMixedValue.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue;

$mockMixedValue1 = new MockMixedValue();

var_dump($mockMixedValue1->value());

$mockMixedValue2 = new MockMixedValue();

var_dump($mockMixedValue2->value());
