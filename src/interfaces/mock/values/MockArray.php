<?php

namespace Darling\PHPMockingUtilities\interfaces\mock\values;

/**
 * A MockArray can be used to mock an empty array.
 *
 * @example
 *
 * ```
 * var_dump($mockArray->value());
 *
 * // example output:
 * array(0) {
 * }
 *
 * ```
 */
interface MockArray
{

    /**
     * Return the MockArray's value.
     *
     * @return array<mixed>
     *
     * @example
     *
     * ```
     * var_dump($mockArray->value());
     *
     * // example output:
     * array(0) {
     * }
     *
     * ```
     *
     */
    public function value(): array;

}

