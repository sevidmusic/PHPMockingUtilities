<?php

namespace Darling\PHPMockingUtilities\tests\mock\classes;

use \Attribute;

#[Attribute]
class AnAttributeClass
{
    public function __construct(public string $value) {}
}
