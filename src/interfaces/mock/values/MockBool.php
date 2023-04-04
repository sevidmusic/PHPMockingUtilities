<?php

namespace Darling\PHPMockingUtilities\interfaces\mock\values;


/**
 * A MockBool can be used to mock a boolean value. A MockBool will
 * always mock the boolean: false
 *
 * @example
 *
 * ```
 * var_dump($mockBool->value());
 *
 * // example output:
 * bool(false)
 *
 * ```
 */
interface MockBool
{

    /**
     * Return the MockBool's value.
     *
     * @return bool
     *
     * @example
     *
     * ```
     * var_dump($mockBool->value());
     *
     * // example output:
     * bool(false)
     *
     * ```
     *
     */
    public function value(): bool;

}



