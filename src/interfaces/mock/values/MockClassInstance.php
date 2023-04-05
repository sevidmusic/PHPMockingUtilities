<?php

namespace Darling\PHPMockingUtilities\interfaces\mock\values;

use \Darling\PHPReflectionUtilities\interfaces\utilities\Reflection;

/**
 * A MockClassInstance can mock an instance of a class or object
 * instance that is reflected by a Reflection.
 *
 * A MockClassInstance can also mock argument values for methods
 * defined by an instance of a class or object instance that is
 * reflected by a Reflection.
 *
 * @example
 *
 * ```
 * var_dump($mocker->reflection()->type()->__toString());
 *
 * // example output:
 * string(8) "stdClass"
 *
 * $mockInstance = $mocker->mockInstance();
 *
 * var_dump($mockInstance);
 *
 * // example output:
 * class stdClass#38 (0) {
 * }
 *
 * var_dump($mocker->mockMethodArguments('__construct'));
 *
 * // example output:
 * array(0) {
 * }
 *
 * ```
 *
 * @see Darling\PHPReflectionUtilities\interfaces\utilities\Reflection
 * @see https://github.com/sevidmusic/PHPReflectionUtilities/blob/main/src/interfaces/utilities/Reflection.php
 *
 */
interface MockClassInstance
{

     /**
      * Return a mock instance of the same type as the
      * class or object instance reflected by the
      * Reflection assigned to this MockClassInstance.
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
      * var_dump($mocker->reflection()->type()->__toString());
      *
      * // example output:
      * string(8) "stdClass"
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
    public function mockInstance(array $constructorArguments = []): object;

     /**
      * Generate mock method arguments for the specified method of the
      * class or object instance reflected by this MockClassInstance's
      * Reflection.
      *
      * @param string $method The name of the method to generate
      *                       arguments for.
      *
      * @return array<mixed>
      *
      * @example
      *
      * ```
      * var_dump($mocker->reflection()->type()->__toString());
      *
      * // example output:
      * string(8) "stdClass"
      *
      * var_dump($mocker->mockMethodArguments('__construct'));
      *
      * // example output:
      * array(0) {
      * }
      *
      * ```
      *
      */
    public function mockMethodArguments(string $method): array;


    /**
     * Return the Reflection that reflects the class or object
     * instance this MockClassInstance mocks.
     *
     * @return Reflection
     *
     * @example
     *
     * ```
     * var_dump($mocker->reflection());
     *
     * // example output:
     * class Darling\PHPReflectionUtilities\classes\utilities\Reflection#25 (1) {
     *   private ReflectionClass $reflectionClass =>
     *   class ReflectionClass#38 (1) {
     *     public string $name =>
     *     string(8) "stdClass"
     *   }
     * }
     *
     * ```
     */
    public function reflection(): Reflection;

}

