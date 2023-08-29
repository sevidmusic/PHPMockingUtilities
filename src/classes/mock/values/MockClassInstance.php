<?php

namespace Darling\PHPMockingUtilities\classes\mock\values;

use ReflectionEnum;
use ReflectionEnumBackedCase;
use ReflectionEnumUnitCase;
use \Closure;
use \Darling\PHPMockingUtilities\classes\mock\values\MockArray;
use \Darling\PHPMockingUtilities\classes\mock\values\MockBool;
use \Darling\PHPMockingUtilities\classes\mock\values\MockClosure;
use \Darling\PHPMockingUtilities\classes\mock\values\MockFloat;
use \Darling\PHPMockingUtilities\classes\mock\values\MockInt;
use \Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue;
use \Darling\PHPMockingUtilities\classes\mock\values\MockString;
use \Darling\PHPMockingUtilities\interfaces\mock\values\MockClassInstance as MockClassInstanceInterface;
use \Darling\PHPMockingUtilities\src\enumerations\MockEnum;
use \Darling\PHPMockingUtilities\src\enumerations\MockBackedEnum;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection;
use \Darling\PHPReflectionUtilities\interfaces\utilities\Reflection as ReflectionInterface;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPTextTypes\classes\strings\UnknownClass;
use \Generator;
use \ReflectionClass;
use \ReflectionClassConstant;
use \ReflectionException;
use \ReflectionExtension;
use \ReflectionFunction;
use \ReflectionGenerator;
use \ReflectionMethod;
use \ReflectionParameter;
use \ReflectionProperty;
use \ReflectionReference;
use \RuntimeException;
use \stdClass;


class MockClassInstance implements MockClassInstanceInterface
{

    private const ARRAY = 'array';
    private const BOOLEAN = 'bool';
    private const CONSTRUCT = '__construct';
    private const DOUBLE = 'double';
    private const FLOAT = 'float';
    private const INTEGER = 'int';
    private const NULL = 'NULL';
    private const STRING = 'string';
    private const MIXED = 'mixed';
    private const OBJECT = 'object';

     /**
      * Instantiate a new instance of a MockClassInstance.
      *
      * Note: It is not possible to mock an instance of a class
      * that defines a private `__construct()` method.
      *
      * For example, it would not be possible to mock either of the
      * following classes:
      *
      * ```
      * class A
      * {
      *     private function __construct() {}
      *
      *     public static function getInstance(): A
      *     {
      *         return new self();
      *     }
      * }
      *
      * class B
      * {
      *     private function __construct() {}
      *
      *     public static function getInstance(bool $parameter): ?B
      *     {
      *         return ($parameter === true ? new self() : null);
      *     }
      * }
      *
      * ```
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
    public function __construct(
        private ReflectionInterface $reflection
    ) {}

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
         return match(
             $this->isAClosure(
                 $this->reflection->type()->__toString()
             )
         ) {
             true => $this->mockClosure(),
             default => $this->getClassInstance($this->reflection->type()->__toString(), $constructorArguments),
         };
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
        if($class === ReflectionClass::class) {
            return new ReflectionClass(UnknownClass::class);
        }
        if($class === ReflectionProperty::class) {
            return new ReflectionProperty(Text::class, 'string');
        }
        if($class === ReflectionClassConstant::class) {
            return new ReflectionClassConstant(MockClassInstance::class, 'CONSTRUCT');
        }
        if($class === ReflectionExtension::class) {
            return new ReflectionExtension('curl');
        }
        if($class === ReflectionMethod::class) {
            return new ReflectionMethod(Text::class, '__toString');
        }
        if($class === ReflectionParameter::class) {
            return new ReflectionParameter([Text::class, '__construct'], 0);
        }
        if($class === ReflectionFunction::class) {
            return new ReflectionFunction(function(): void {});
        }
        if($class === ReflectionGenerator::class) {
            return new ReflectionGenerator($this->mockGenerator());
        }
        if($class === ReflectionEnum::class) {
            return new ReflectionEnum(MockEnum::class);
        }
        if($class === ReflectionEnumBackedCase::class) {
            return new ReflectionEnumBackedCase(
                MockBackedEnum::class, 'Bar'
            );
        }
        if($class === ReflectionEnumUnitCase::class) {
            return new ReflectionEnumUnitCase(
                MockEnum::class,
                'Foo'
            );
        }
        if($class === ReflectionReference::class) {
            $referencedValue = 'referencedValue';
            /** @var ReflectionReference $reflectionReference */
            $reflectionReference = ReflectionReference::fromArrayElement(
                [&$referencedValue],
                0
            );
            return $reflectionReference;
        }
        if (method_exists($class, self::CONSTRUCT) === false) {
            return $this->reflectionClass($class)
                        ->newInstanceArgs([]);
        }
        $constructReflection = new ReflectionMethod($class, self::CONSTRUCT);
        if($constructReflection->isPrivate()) {
            return new RuntimeException(
                'The ' .
                (is_object($class) ? $class::class : $class) .
                ' class defines a private ' .
                self::CONSTRUCT .
                ' method. '  .
                'It is not possible to mock an instance of a ' .
                'class that defines a private ' .
                self::CONSTRUCT .
                ' method'
            );
        }
        return match(empty($constructorArguments)) {
            true => $this->reflectionClass($class)
                        ->newInstanceArgs(
                            $this->generateMockClassMethodArguments(
                                $class,
                                self::CONSTRUCT
                            )
                        ),
            default => $this->reflectionClass($class)
                            ->newInstanceArgs($constructorArguments),
        };
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
        $classString = new ClassString($class);
        $reflection = new Reflection($classString);
        $defaults = array();
        if(method_exists($class, $method)) {
            foreach (
                $reflection->methodParameterTypes($method)
                as
                $name => $types
            ) {
                foreach($types as $type) {
                    if($type === Generator::class) {
                        $defaults[$name] = $this->mockGenerator();
                        continue;
                    }
                    if($this->isAClosure($type)) {
                        $defaults[$name] = $this->mockClosure();
                        continue;
                    }
                    if($type === \Stringable::class) {
                        $defaults[$name] = $this->mockString();
                        continue;
                    }
                    if ($type === self::BOOLEAN) {
                        $defaults[$name] = $this->mockBool();
                        continue;
                    }
                    if ($type === self::INTEGER) {
                        $defaults[$name] = $this->mockInt();
                        continue;
                    }
                    if($type === self::FLOAT) {
                        $defaults[$name] = $this->mockFloat();
                        continue;
                    }
                    if ($type === self::DOUBLE) {
                        $defaults[$name] = $this->mockFloat();
                        continue;
                    }
                    if ($type === self::STRING) {
                        $defaults[$name] = $this->mockString();
                        continue;
                    }
                    if ($type === self::ARRAY) {
                        $defaults[$name] = $this->mockArray();
                        continue;
                    }
                    if ($type === self::MIXED) {
                        $defaults[$name] = $this->mockMixedValue();
                        continue;
                    }
                    if ($type === self::NULL) {
                        $defaults[$name] = null;
                        continue;
                    }
                    if ($type === self::OBJECT) {
                        $defaults[$name] = new stdClass();
                        continue;
                    }
                    $this->attemptToAddAMockInstanceOfTheSpecifiedTypeToArrayUnderTheSpecifiedIndex(
                        $type,
                        $name,
                        $defaults
                    );
                    if(empty($defaults)) {
                        throw new RuntimeException(
                            PHP_EOL .
                            PHP_EOL .
                            self::class .
                            ' Error:' .
                            PHP_EOL .
                            PHP_EOL .
                            'Failed to mock argument: $' .
                            $name .
                            PHP_EOL .
                            PHP_EOL .
                            'Expected argument type: ' .
                            $type .
                            PHP_EOL .
                            PHP_EOL .
                            'Method: ' .
                            $method .
                            '()' .
                            PHP_EOL .
                            PHP_EOL
                        );
                    }
                }
            }
        }
        return $defaults;
    }

    /**
     * Attempt to add a mock instance of the specified $class
     * to the specified array of $values under the specified
     * $index.
     *
     * If an instance of the specified class can not be mocked,
     * than the array of $values will not be modified.
     *
     * @param string $class The expected type.
     *
     * @param string $index The index to assign the instance to
     *                      in the array of $values.
     *
     * @param array<mixed> $values The array of values to add the
     *                             instance to.
     */
    private function attemptToAddAMockInstanceOfTheSpecifiedTypeToArrayUnderTheSpecifiedIndex(
        string $class,
        string $index,
        &$values
    ): void
    {
        /**
         * Note:
         *
         * It is not normally possible to mock an interface or
         * abstract class since they can not be instantiated.
         *
         * However, Darling libraries use a naming convention for
         * their namespaces that allows this to be overcome.
         *
         * By modifying $class so the words 'interfaces' and
         * 'abstractions' are replaced by the word 'classes'
         * the correct class can be mocked when a type accepts
         * an instance of a Darling interface or abstract class.
         *
         * THIS ONLY APPLIES TO CLASSES DEFINED BY DARLING LIBRARIES.
         *
         * Attempts to mock any other interface or abstract class
         * will most likely fail unless they happen to use a
         * namespace that follows one of the following naming
         * patterns:
         *
         * ```
         * namespace Darling\...\interfaces\...\InterfaceName
         * namespace Darling\...\abstractions\...\AbstractClassName
         *
         * ```
         *
         * @var class-string<object> $class
         */
        if(substr($class, 0, 7) === 'Darling') {
            $class = '\\' . str_replace(
                ['interfaces', 'abstractions'],
                ['classes'],
                $class
            );
        }
        /**
         * If $class matches an existing class assign an instance of
         * that class to the $values array under the specified $index.
         */
        if(class_exists($class)) {
            $values[$index] = $this->getClassInstance(
                $class
            );
        }
    }

    /**
     * @return array<mixed>
     */
    private function mockArray(): array
    {
        $mockArray = new MockArray();
        return $mockArray->value();
    }

    private function mockString(): string
    {
        $mockString = new MockString();
        return $mockString->value();
    }

    private function mockBool(): bool
    {
        $mockBool = new MockBool();
        return $mockBool->value();
    }

    private function mockClosure(): Closure
    {
        $mockClosure = new MockClosure();
        return $mockClosure->value();
    }

    private function mockFloat(): float
    {
        $mockFloat = new MockFloat();
        return $mockFloat->value();
    }

    private function mockInt(): int
    {
        $mockInt = new MockInt();
        return $mockInt->value();
    }

    private function mockMixedValue(): mixed
    {
        $mockMixedValue = new MockMixedValue();
        return $mockMixedValue->value();
    }

    private function isAClosure(string $type): bool
    {
        return $type === \Closure::class || $type === 'callable';
    }

    /**
     * This method is used by MockClassInstance::getClassInstance()
     * to mock a ReflectionGenerator.
     *
     * This Generator will be passed to the __construct() method of
     * the ReflectionGenerator being mocked.
     *
     * @return Generator
     *
     * @example
     *
     * ```
     *
     * class MockClassInstance implements MockClassInstanceInterface
     * {
     * private function getClassInstance(
     *     string|object $class,
     *     array $constructorArguments = []
     * ): object
     *     {
     *         ...
     *         if($class === ReflectionGenerator::class) {
     *             return new ReflectionGenerator(mockGenerator());
     *         }
     *         ...
     *     }
     * }
     *
     * ```
     *
     */
    private function mockGenerator(): Generator {
        $max = rand(10, 100);
        for ($i = 1; $i <= $max; $i++) {
            yield $i;
        }
    }
}

