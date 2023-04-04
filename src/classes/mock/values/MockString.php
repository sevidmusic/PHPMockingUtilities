<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockString as MockStringInterface;
use Darling\PHPTextTypes\classes\strings\Text;
use Darling\PHPTextTypes\classes\strings\Id;

class MockString extends Text implements MockStringInterface
{

    public function __construct()
    {
        parent::__construct($this->mockString());
    }

    private function mockString(): string
    {
        $id = new Id();
        $id = substr($id, 0, (49 - mb_strlen('MockString')));
        $id = 'MockString' . $id;
        return $id;
    }

    public function __toString(): string
    {
        return parent::__toString();
    }

    public function value(): string
    {
        return parent::__toString();
    }
}

