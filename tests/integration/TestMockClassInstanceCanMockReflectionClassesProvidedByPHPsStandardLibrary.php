<?php

require(
    str_replace(
        'tests' . DIRECTORY_SEPARATOR . 'integration',
        'vendor',
        __DIR__,
    ) . DIRECTORY_SEPARATOR . 'autoload.php'
);

use \Darling\PHPMockingUtilities\tests\mock\classes\AnAttributeClass;
use \Darling\PHPMockingUtilities\tests\mock\classes\TestEnum;
use \Darling\PHPMockingUtilities\tests\mock\classes\TestEnumBacked;
use \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection as DarlingReflection;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Text;

function bazzerBazFoo(): void {}

function intGenerator(int $max): Generator {
    for ($i = 1; $i <= $max; $i++) {
        yield $i;
    }
}


/**
 * Return a instance of a PHP standard library reflection class or
 * a Darling PHP reflection utilities class.
 *
 * @return DarlingReflection|Reflection|ReflectionAttribute<object>|ReflectionClass<AnAttributeClass>|ReflectionClass<Text>|ReflectionClassConstant|ReflectionEnum|ReflectionException|ReflectionExtension|ReflectionFiber|ReflectionFunction|ReflectionGenerator|ReflectionIntersectionType|ReflectionMethod|ReflectionNamedType|ReflectionObject|ReflectionParameter|ReflectionProperty|ReflectionReference|ReflectionUnionType
 *
 */
function instanceOfAPHPStandardLibraryReflectionOrDarlingPHPReflectionUtilitiesClass(): DarlingReflection|Reflection|ReflectionAttribute|ReflectionClass|ReflectionClassConstant|ReflectionEnum|ReflectionException|ReflectionExtension|ReflectionFiber|ReflectionFunction|ReflectionGenerator|ReflectionIntersectionType|ReflectionMethod|ReflectionNamedType|ReflectionObject|ReflectionParameter|ReflectionProperty|ReflectionReference|ReflectionUnionType
{
    $referencedValue = 'value';
    /** @var ReflectionReference $reflectionReference */
    $reflectionReference = ReflectionReference::fromArrayElement(
        [&$referencedValue],
        0
    );
    $reflectedClassWithAttributes = new ReflectionClass(AnAttributeClass::class);
    $attributes = $reflectedClassWithAttributes->getAttributes();
    $classes = [
        new ReflectionGenerator(intGenerator(PHP_INT_MAX)),
        new ReflectionParameter([Text::class, '__construct'], 0),
        new ReflectionFunction(function(): void {}),
        new ReflectionMethod(Text::class, '__toString'),
        new ReflectionExtension('curl'),
        new ReflectionClassConstant(MockClassInstance::class, 'CONSTRUCT'),
        new DarlingReflection(new ClassString(Text::class)),
        new Reflection(),
        new ReflectionClass(Text::class),
        new ReflectionException(),
        new ReflectionFiber(new Fiber(function(): string { return 'foo'; })),
        new ReflectionIntersectionType(),
        new ReflectionNamedType(),
        new ReflectionObject(new Text('foo bar baz')),
        new ReflectionProperty(Text::class, 'string'),
        new ReflectionUnionType(),
        $reflectionReference,
        new ReflectionEnum(TestEnum::class),
        new ReflectionEnumBackedCase(TestEnumBacked::class, 'Bar'),
        new ReflectionEnumUnitCase(TestEnum::class, 'Foo'),
        (
            # Testing ReflectionAttribute() which cannot be
            # instantiated because of a private __construct()
            isset($attributes[0])
            ? $attributes[0]
            : new ReflectionClass(AnAttributeClass::class)
        ),
#        // NOT TESTED YET
#        new ReflectionZendExtension(''),
   ];
    return $classes[array_rand($classes)];
}

$instance = instanceOfAPHPStandardLibraryReflectionOrDarlingPHPReflectionUtilitiesClass();
$mi = new MockClassInstance(
    new DarlingReflection(new ClassString($instance))
);

// Determine if class defines a __construct method, if so reflect it.
if(method_exists($instance::class, '__construct')) {
    $constructorReflection = new ReflectionMethod($instance::class, '__construct');
}

echo "\033[38;5;0m\033[48;5;111mRunning test" . __FILE__ . " \033[48;5;0m";

/**
 * If the class defines a private __construct method a
 * RuntimeException should be returned by $mi->mockInstance()
 */
if(isset($constructorReflection) && $constructorReflection->isPrivate()) {
    if($mi->mockInstance()::class === RuntimeException::class) {
        echo "\033[38;5;0m\033[48;5;84mPassed\033[48;5;0m";
    } else {
        echo "\033[38;5;0m\033[48;5;196mFailed\033[48;5;0m";
    }
} else {
    if($mi->mockInstance()::class === $instance::class) {
        echo "\033[38;5;0m\033[48;5;84mPassed\033[48;5;0m";
    } else {
        echo "\033[38;5;0m\033[48;5;196mFailed\033[48;5;0m";
    }
}

