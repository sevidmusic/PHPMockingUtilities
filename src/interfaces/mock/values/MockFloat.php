<?php

namespace Darling\PHPMockingUtilities\interfaces\mock\values;

/**
 * A MockFloat can be used to mock an float within the range of
 * PHP_FLOAT_MIN and PHP_FLOAT_MAX.
 *
 * @example
 *
 * ```
 * var_dump($mockFloat->value());
 *
 * // example output:
 * double(803.597)
 *
 * ```
 * @see https://www.php.net/manual/en/reserved.constants.php#PHP_FLOAT_MIN
 * @see https://www.php.net/manual/en/reserved.constants.php#PHP_FLOAT_MAX
 */
interface MockFloat
{

    /**
     * Return the MockFloat's value.
     *
     * @return float
     *
     * @example
     *
     * ```
     * var_dump($mockFloat->value());
     *
     * // example output:
     * double(803.597)
     *
     * ```
     *
     */
    public function value(): float;

}

