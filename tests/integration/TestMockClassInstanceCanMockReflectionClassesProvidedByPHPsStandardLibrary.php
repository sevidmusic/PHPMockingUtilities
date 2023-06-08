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
function reflectionClassOrReflectionProperty(): mixed
{
    /** @var array<ReflectionClass<object>|ReflectionProperty> $classes */
    $classes = [
        new DarlingReflection(new ClassString(Text::class)),
        new Reflection(),
        new ReflectionClass(Text::class),
        new ReflectionClassConstant(MockClassInstance::class, 'CONSTRUCT'),
        new ReflectionEnum(FooBarBaz::class),
        new ReflectionEnumUnitCase(FooBarBaz::class, 'Foo'),
        new ReflectionEnumBackedCase(FooBarBazBacked::class, 'Bar'),
        # NOT TESTED YET: new ReflectionZendExtension(''),
        new ReflectionExtension('curl'),
        new ReflectionFunction('bazzerBazFoo'),
        new ReflectionMethod(Text::class, '__toString'),
        new ReflectionNamedType(),
        new ReflectionObject(new Text('foo bar baz')),
        new ReflectionParameter([Text::class, '__construct'], 0),
        new ReflectionProperty(Text::class, 'string'),
        new ReflectionUnionType(),
        new ReflectionGenerator(intGenerator(PHP_INT_MAX)),
        new ReflectionFiber(
            new Fiber(function(): string { return 'foo'; })
        ),
        new ReflectionIntersectionType(),
        ReflectionReference::fromArrayElement(['foo'], 0),
        # NOT TESTED YET: new ReflectionAttribute(),
        new ReflectionException(),
        new ReflectionClass(Text::class),
        new ReflectionProperty(Text::class, 'string'),
    ];
    return $classes[array_rand($classes)];
}


$mi = new MockClassInstance(
    new DarlingReflection(
        new ClassString(
            reflectionClassOrReflectionProperty()
        )
    )
);

var_dump($mi->mockInstance());

