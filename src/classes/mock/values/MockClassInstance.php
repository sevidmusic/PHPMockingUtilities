<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use \Closure;
use \Darling\PHPMockingUtilities\classes\mock\values\MockArray;
use \Darling\PHPMockingUtilities\classes\mock\values\MockBool;
use \Darling\PHPMockingUtilities\classes\mock\values\MockClosure;
use \Darling\PHPMockingUtilities\classes\mock\values\MockFloat;
use \Darling\PHPMockingUtilities\classes\mock\values\MockInt;
use \Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue;
use \Darling\PHPMockingUtilities\classes\mock\values\MockString;
use \Darling\PHPMockingUtilities\interfaces\mock\values\MockClassInstance as MockClassInstanceInterface;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection;
use \Darling\PHPReflectionUtilities\interfaces\utilities\Reflection as ReflectionInterface;
use \Darling\PHPTextTypes\classes\strings\UnknownClass;
use \ReflectionClass;
use \ReflectionException;
use \RuntimeException;
use \stdClass;

class MockClassInstance implements MockClassInstanceInterface
{

     /**
      * Instantiate a new instance of a MockClassInstance.
      *
      * @example
      *
      * ```
      * $mocker = new MockClassInstance(
      *     new Reflection(
      *         new \ReflectionClass(new \stdClass())
      *     );
      *
      * ```
      *
      * @see \Darling\PHPReflectionUtilities\classes\utilities\Reflection
      * @see https://github.com/sevidmusic/PHPReflectionUtilities/blob/main/src/interfaces/utilities/Reflection.php
      * @see \ReflectionClass
      * @see https://www.php.net/manual/en/class.reflectionclass
      *
      */
    public function __construct(private ReflectionInterface $reflection) {}

    public function reflection(): ReflectionInterface
    {
        return $this->reflection;
    }

    public function mockMethodArguments(string $method): array
    {
        return [];
    }


     public function mockInstance(
         array $constructorArguments = []
     ): object
     {
         return $this;
     }

}

