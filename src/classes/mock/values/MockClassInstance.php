<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use Darling\PHPMockingUtilities\interfaces\mock\values\MockClassInstance as MockClassInstanceInterface;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection;
use \Darling\PHPReflectionUtilities\interfaces\utilities\Reflection as ReflectionInterface;
use \Darling\PHPTextTypes\classes\strings\SafeText;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPTextTypes\classes\strings\UnknownClass;
use \ReflectionClass;
use \ReflectionException;
use \RuntimeException;
use \stdClass;

class MockClassInstance implements MockClassInstanceInterface
{

    private const ARRAY = 'array';
    private const BOOLEAN = 'bool';
    private const CONSTRUCT = '__construct';
    private const DOUBLE = 'double';
    private const INTEGER = 'int';
    private const NULL = 'NULL';
    private const STRING = 'string';

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

    public function mockMethodArguments(string $method): array
    {
        return $this->generateMockClassMethodArguments(
            $this->reflection()->type()->__toString(),
            $method
        );
    }

    public function reflection(): ReflectionInterface
    {
        return $this->reflection;
    }

     /**
      * Return an instance of a ReflectionClass that reflects the
      * specified class or object instance.
      *
      * @param class-string|object $class
      *
      * @return ReflectionClass<object>
      *
      * @example
      *
      * ```
      * var_dump($this->reflectionClass(new stdClass()));
      *
      * // example output:
      * class ReflectionClass#1 (1) {
      *   public string $name =>
      *   string(8) "stdClass"
      * }
      *
      * ```
      * @todo Consider refactoring $class to accept Darling\PHPTextTypes\classes\strings\ClassString once https://github.com/sevidmusic/PHPReflectionUtilities/issues/25 is resolved
      *
      */
     private function reflectionClass(
         string|object $class
     ): ReflectionClass
    {
        if(
            class_exists(
                (
                    is_object($class)
                    ? $class::class
                    : $class
                )
            )
        ) {
            return new ReflectionClass($class);
        }
        return new ReflectionClass(new UnknownClass());
    }

     /**
      * Return a mock instance of the same type as the
      * class or object instance reflected by the
      * Reflection assigned to the $reflection property.
      *
      * If supplied, the specified $constructorArguments will
      * be passed to the mock instance's constructor.
      *
      * @param array<mixed> $constructorArguments
      *
      * @return object
      *
      * @example
      *
      * ```
      * $mocker = new Mocker(new ObjectReflection(new stdClass()));
      *
      * $mockInstance = $mocker->mockInstance();
      *
      * var_dump($mockInstance);
      *
      * // example output:
      * class stdClass#38 (0) {
      * }
      *
      * ```
      *
      */
     public function mockInstance(
         array $constructorArguments = []
     ): object
     {
         return $this->getClassInstance(
             $this->reflection->type()->__toString(),
             $constructorArguments
         );
     }

     /**
      * Return a mock instance of the same type as the
      * specified class or object instance.
      *
      * If supplied, the specified $constructorArguments will
      * be passed to the mock instance's constructor.
      *
      * @param class-string|object $class
      *
      * @param array<mixed> $constructorArguments
      *
      * @return object
      *
      * @example
      *
      * ```
      * $mockInstance = $this->getClassInstance(new stdClass());
      *
      * var_dump($mockInstance);
      *
      * // example output:
      * class stdClass#38 (0) {
      * }
      *
      * ```
      *
      */
     private function getClassInstance(
         string|object $class,
         array $constructorArguments = []
     ): object
     {
        if (method_exists($class, self::CONSTRUCT) === false) {
            try {
                return $this->reflectionClass($class)
                            ->newInstanceArgs([]);
            } catch (ReflectionException $e) {
                return $e;
            }
        }
        if (empty($constructorArguments) === true) {
            try {
                return $this->reflectionClass($class)
                            ->newInstanceArgs(
                                $this->generateMockClassMethodArguments(
                                    $class,
                                    self::CONSTRUCT
                                )
                );
            } catch (ReflectionException $e) {
                return $e;
            }
        }
        return $this->reflectionClass($class)->newInstanceArgs(
            $constructorArguments
        );
    }

     /**
      * Generate mock method arguments for the specified method of the
      * provided class or object instance.
      *
      * @param class-string|object $class The class or object instance.
      *
      * @param string $method The name of the method to generate
      *                       arguments for.
      *
      * @return array<mixed>
      *
      * @example
      *
      * ```
      * //
      * var_dump(
      *     $mocker->generateMockClassMethodArguments(
      *         \Darling\PHPTextTypes\classes\strings\Text::class,
      *         '__construct'
      *     )
      * );
      *
      * array(1) {
      *   'string' =>
      *   string(21) "Mocker-DEFAULT_STRING"
      * }
      *
      * ```
      *
      */
    private function generateMockClassMethodArguments(
         string|object $class,
         string $method
    ): array
    {
        $reflection = new Reflection($this->reflectionClass($class));
        $defaultText = new SafeText(new Text(self::class . '-DEFAULT_STRING'));
        $defaults = array();
        if(method_exists($class, $method)) {
            foreach (
                $reflection->methodParameterTypes($method)
                as
                $name => $types
            ) {
                foreach($types as $type) {
                    if ($type === self::BOOLEAN) {
                        $defaults[$name] = false;
                        continue;
                    }
                    if ($type === self::INTEGER) {
                        $defaults[$name] = 1;
                        continue;
                    }
                    if ($type === self::DOUBLE) {
                        $defaults[$name] = 1.2345;
                        continue;
                    }
                    if ($type === self::STRING) {
                        $defaults[$name] = $defaultText->__toString();
                        continue;
                    }
                    if ($type === self::ARRAY) {
                        $defaults[$name] = [];
                        continue;
                    }
                    if ($type === self::NULL) {
                        $defaults[$name] = null;
                        continue;
                    }
                    /**
                     * For unknown types check if $type matches an
                     * existing class, if so, assign an instance of
                     * that class.
                     * @var class-string<object> $type
                     */
                    $type = '\\' . str_replace(
                        ['interfaces'],
                        ['classes'],
                        $type
                    );
                    if(class_exists($type)) {
                        $defaults[$name] = $this->getClassInstance(
                            $type
                        );
                    }
                    if(empty($defaults)) {
                        throw new RuntimeException(
                            self::class .
                            ' Error:' .
                            PHP_EOL .
                            'Failed to mock argument ' .
                            $name .
                            ' of type ' .
                            $type .
                            ' for method ' .
                            self::class .
                            '->' .
                            $method
                        );
                    }
                }
            }
        }
        return $defaults;
    }

}

