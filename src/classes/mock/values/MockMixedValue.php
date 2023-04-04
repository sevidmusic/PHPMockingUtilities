<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockMixedValue as MockMixedValueInterface;
use \Darling\PHPTextTypes\classes\strings\Text;
use \stdClass;

final class MockMixedValue implements MockMixedValueInterface
{

    private mixed $value = null;

    public function __construct()
    {
        $this->value = $this->randomValue();
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
            null,
            new Text('MockMixedValue'),
        ];
        return $values[array_rand($values)];
    }

    public function value(): mixed
    {
        return $this->value;
    }

}

