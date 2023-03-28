<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockMixedValue as MockMixedValueInterface;
use \stdClass;

class MockMixedValue implements MockMixedValueInterface
{

    public function __construct(private mixed $value = null)
    {
        if(!isset($this->value)) {
            $this->value = $this->randomValue();
        }
    }

    private function randomValue(): mixed
    {
        $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $values = [
            rand(0, 100),
            str_shuffle($letters),
            true,
            false,
            [],
            function(): void {},
            new stdClass(),
        ];
        return $values[array_rand($values)];
    }

    public function value(): mixed
    {
        return $this->value;
    }

}

