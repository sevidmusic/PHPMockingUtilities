<?php

namespace Darling\PHPMockingUtilities\interfaces\mock\values;

use \Darling\PHPTextTypes\interfaces\strings\Text;

/**
 * A MockString is Text that can be used to mock a string.
 *
 * A MockString will consist of alphanumeric characters, will be
 * greater than 40 characters in length, will be less than 50
 * characters in length, and will begin with the string "MockString".
 *
 * @example
 *
 * ```
 * var_dump($mockString->value());
 *
 * // example output:
 * string(48) "MockStringkUr6KIOelSgAFhsC4uqGwX5nZcVzp3R7WNYjtH"
 *
 * ```
 */
interface MockString extends Text
{

    /**
     * Return the MockString's value.
     *
     * @return string
     *
     * @example
     *
     * ```
     * var_dump($mockString->value());
     *
     * // example output:
     * string(48) "MockStringkUr6KIOelSgAFhsC4uqGwX5nZcVzp3R7WNYjtH"
     *
     * ```
     *
     */
    public function value(): string;

}

