<?php

namespace Darling\PHPMockingUtilities\interfaces\mock\values;

/**
 * A MockMixedValue can be used to mock a value.
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
interface MockMixedValue
{

    /**
     * Return the value of this MockMixedValue.
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

