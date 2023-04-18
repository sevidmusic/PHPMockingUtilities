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
    public function __construct(private ReflectionInterface $reflection) {
        $this->reflection = new Reflection(
            new ReflectionClass(
                $this->determineClassString(
                    $reflection->type()->__toString()
                )
            )
        );
    }

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


    /**
     * Return the class string of the specified $class.
     *
     * $class may be a class string, or an object instance.
     *
     * @return class-string<object>
     *
     * @example
     *
     * ```
     * var_dump($this->determineClassString(\stdClass::class);
     *
     * // example output:
     * string(8) "stdClass"
     *
     * var_dump($this->determineClassString(new \stdClass());
     *
     * // example output:
     * string(8) "stdClass"
     *
     * ```
     *
     */
    protected function determineClassString(string|object $class): string
    {
        return match(is_object($class)) {
            true => $class::class,
            default => $this->validateClassString($class),
        };
    }


    /**
     * Validate the specified $classString.
     *
     * If the specified $classString does not correspond to an
     * existing class, then the class string for an UnknownClass
     * will be returned.
     *
     * If the $classString corresponds to an interface or abstract
     * class that is not defined under a Darling namespace, then
     * the class string for an UnknownClass will be returned.
     *
     * If the $classString corresponds to a interface or abstract
     * class that is defined under a Darling namespace, then it
     * will be modified to reflect the appropriate Darling class.
     *
     * For example, the following $classString:
     *
     * ```
     * Darling\\LibraryName\\interfaces\\Foo\\Bar\\Baz
     *
     * ```
     *
     * Would be modified to be:
     *
     * ```
     * Darling\\LibraryName\\classes\\Foo\\Bar\\Baz
     *
     * ```
     *
     * If the specified class string corresponds to an existing
     * class that is not abstract, then it will be returned
     * unmodified.
     *
     * @return class-string<object>
     *
     * @example
     *
     * ```
     * var_dump($this->validateClassString(\stdClass::class);
     *
     * // example output:
     * string(8) "stdClass"
     *
     * var_dump(
     *     $this->validateClassString(
     *         "Darling\\PHPTextTypes\\interfaces\\strings\\Name"
     *     )
     * );
     *
     * // example output:
     * string(41) "Darling\\PHPTextTypes\\classes\\strings\\Name"
     *
     * ```
     *
     */
    private function validateClassString(string $classString): string
    {
        if(!interface_exists($classString) && !class_exists($classString)) {
            return UnknownClass::class;
        }
        $this->correctDarlingNamespaces($classString);
        $reflectionClass = new \ReflectionClass($classString);
        return match(
            $reflectionClass->isInterface()
            ||
            $reflectionClass->isAbstract()
        ) {
            true => UnknownClass::class,
            default => $classString,
        };
    }

    protected function correctDarlingNamespaces(string &$class): void
    {
        if(
            substr($class, 0, 7) === 'Darling'
            &&
            !str_contains($class, '\\tests\\')
            &&
            $class !== UnknownClass::class
        ) {
            $class = str_replace(
                ['interfaces', 'abstractions'],
                'classes',
                $class
            );
        }
    }
}

