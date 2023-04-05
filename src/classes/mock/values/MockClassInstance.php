<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockClassInstance as MockClassInstanceInterface;
use \stdClass;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection;
use \Darling\PHPReflectionUtilities\interfaces\utilities\Reflection as ReflectionInterface;
use \ReflectionClass;

class MockClassInstance implements MockClassInstanceInterface
{

    public function __construct(private ReflectionInterface $reflection) {}

    public function mockInstance(array $constructorArguments = []): object
    {
        return new stdClass();
    }

    public function mockMethodArguments(string $method): array
    {
        return [];
    }

    public function reflection(): ReflectionInterface
    {
        return $this->reflection;
    }
}

