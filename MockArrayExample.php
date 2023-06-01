<?php

/**
 * This file provides an example that demonstrate how to use a
 * MockArray.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockArray;

$mockArray = new MockArray();

var_dump($mockArray->value());

