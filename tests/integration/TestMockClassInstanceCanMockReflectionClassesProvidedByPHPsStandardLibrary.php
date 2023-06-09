<?php

require(
    str_replace(
        'tests' . DIRECTORY_SEPARATOR . 'integration',
        'vendor',
        __DIR__,
    ) . DIRECTORY_SEPARATOR . 'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection as DarlingReflection;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\UnknownClass;
use \Darling\PHPTextTypes\classes\strings\Text;

enum FooBarBaz
{
    case Foo;
    case Bar;
    case Baz;
}

enum FooBarBazBacked: string
{
    case Foo = 'foo';
    case Bar = 'bar';
    case Baz = 'baz';
}

function bazzerBazFoo(): void {}

function intGenerator(int $max): Generator {
    for ($i = 1; $i <= $max; $i++) {
        yield $i;
    }
}

/**
 * Return an instance of either a ReflectionClass or
 * a ReflectionProperty.
 *
 * @return ReflectionClass<object>|ReflectionProperty
 *
 */
function instanceOfAStandardLibraryReflectionType(): mixed
{
    $referencedValue = 'value';
    /** @var ReflectionReference $reflectionReference */
    $reflectionReference = ReflectionReference::fromArrayElement(
        [&$referencedValue],
        0
    );
    /** @var array<ReflectionClass<object>|ReflectionProperty> $classes */
    $classes = [
#        new ReflectionGenerator(intGenerator(PHP_INT_MAX)),
#        new ReflectionParameter([Text::class, '__construct'], 0),
#        new ReflectionFunction(function(): void {}),
#        new ReflectionMethod(Text::class, '__toString'),
#        new ReflectionExtension('curl'),
#        new ReflectionClassConstant(MockClassInstance::class, 'CONSTRUCT'),
#        new DarlingReflection(new ClassString(Text::class)),
#        new Reflection(),
#        new ReflectionClass(Text::class),
#        new ReflectionClass(Text::class),
#        new ReflectionException(),
#        new ReflectionFiber( new Fiber(function(): string { return 'foo'; })),
#        new ReflectionIntersectionType(),
#        new ReflectionNamedType(),
#        new ReflectionObject(new Text('foo bar baz')),
#        new ReflectionProperty(Text::class, 'string'),
#        new ReflectionUnionType(),
        $reflectionReference,
#        // THE FOLLOWING WILL NEED MOCKS
#        new ReflectionEnum(FooBarBaz::class), # Fails
#        new ReflectionEnumBackedCase(FooBarBazBacked::class, 'Bar'), # Fails
#        new ReflectionEnumUnitCase(FooBarBaz::class, 'Foo'), # Fails
#        // NOT TESTED YET
#        new ReflectionZendExtension(''),
#        new ReflectionAttribute(),
   ];
    return $classes[array_rand($classes)];
}

$mi = new MockClassInstance(
    new DarlingReflection(
        new ClassString(
            instanceOfAStandardLibraryReflectionType()
        )
    )
);

var_dump($mi->mockInstance());

