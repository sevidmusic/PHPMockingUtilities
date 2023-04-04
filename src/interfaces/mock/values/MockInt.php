<?php

namespace Darling\PHPMockingUtilities\interfaces\mock\values;

/**
 * A MockInt can be used to mock an integer within the range of
 * PHP_INT_MIN and PHP_INT_MAX.
 *
 * @example
 *
 * ```
 * var_dump($mockInt->value());
 *
 * // example output:
 * int(-5669979968970158592)
 *
 * ```
 * @see https://www.php.net/manual/en/reserved.constants.php#PHP_INT_MIN
 * @see https://www.php.net/manual/en/reserved.constants.php#PHP_INT_MAX
 */
interface MockInt
{

    /**
     * Return the MockInt's value.
     *
     * @return int
     *
     * @example
     *
     * ```
     * var_dump($mockInt->value());
     *
     * // example output:
     * int(8668326)
     *
     * ```
     *
     */
    public function value(): int;

}

