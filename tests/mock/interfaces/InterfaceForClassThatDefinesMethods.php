<?php

namespace Darling\PHPMockingUtilities\tests\mock\interfaces;

/**
 * The following classes are defined here for use by
 * the MockClassInstanceTest
 *
 */

interface InterfaceForClassThatDefinesMethods
{
    /**
     * A method that expects arguments.
     *
     * @param array<mixed> $array
     * @param string|array<mixed> $moreThanOneTypeAccepted
     *
     * @return void
     *
     * @example
     *
     * ```
     *
     * ```
     *
     */
    public function methodWithArguments(
        #ClassThatDoesDefineMethods $classThatDoesDefineMethods,
        #ClassThatDoesNotDefineMethods $classThatDoesNotDefineMethods,
        \Stringable $stringable,
        \Closure $closure,
        \Darling\PHPTextTypes\classes\strings\Id $id,
        \Darling\PHPTextTypes\interfaces\strings\Text $text,
        array $array,
        bool $bool,
        float $float,
        int $int,
        mixed $mixed,
        null|bool|int $nullableParameter,
        object $object, # fails
        string $string,
        string|array $moreThanOneTypeAccepted,
        mixed ...$mixedVariadic,
    ): void;
}