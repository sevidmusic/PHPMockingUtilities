<?php

namespace Darling\PHPMockingUtilities\interfaces\mock\values;

use \closure;

/**
 * A MockClosure can be used to mock a closure.
 *
 * @example
 *
 * ```
 * var_dump($mockClosure->value());
 *
 * // example output:
 * class Closure#1 (0) {
 *   virtual $closure =>
 *   "{closure}"
 * }
 *
 * ```

 */
interface MockClosure
{

    /**
     * Return the MockClosure's value.
     *
     * @return closure
     *
     * @example
     *
     * ```
     * var_dump($mockClosure->value());
     *
     * // example output:
     * class Closure#1 (0) {
     *   virtual $closure =>
     *   "{closure}"
     * }
     *
     * ```
     *
     */
    public function value(): closure;

}

