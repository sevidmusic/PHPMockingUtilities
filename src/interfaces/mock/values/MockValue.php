<?php

namespace Darling\PHPMockingUtilities\interfaces\mock\values;

/**
 * A MockValue can be used to mock a value.
 *
 * @example
 *
 * ```
 * var_dump($mockvalue->value());
 *
 * // example output:
 * bool(true)
 *
 * ```
 */
interface MockValue
{

    /**
     * Return the value of this MockValue.
     *
     * @return mixed
     *
     * @example
     *
     * ```
     * var_dump($mockvalue->value());
     *
     * // example output:
     * int(88)
     *
     * ```
     *
     */
    public function value(): mixed;

}

