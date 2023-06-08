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
#        new DarlingReflection(new ClassString(Text::class)),
#        new Reflection(),
#        new ReflectionClass(Text::class),
#        new ReflectionNamedType(),
#        new ReflectionObject(new Text('foo bar baz')),
#        new ReflectionProperty(Text::class, 'string'),
#        new ReflectionUnionType(),
#        new ReflectionFiber( new Fiber(function(): string { return 'foo'; })),
#        new ReflectionIntersectionType(),
#        new ReflectionException(),
#        new ReflectionClass(Text::class),
#        new ReflectionGenerator(intGenerator(PHP_INT_MAX)), # Fails
#        new ReflectionParameter([Text::class, '__construct'], 0), # Fails
#        new ReflectionClassConstant(MockClassInstance::class, 'CONSTRUCT'), # Fails
#        new ReflectionEnum(FooBarBaz::class), # Fails
#        new ReflectionEnumUnitCase(FooBarBaz::class, 'Foo'), # Fails
#        new ReflectionEnumBackedCase(FooBarBazBacked::class, 'Bar'), # Fails
#        # NOT TESTED YET: new ReflectionZendExtension(''), # Fails
#        new ReflectionExtension('curl'), # Fails
#        new ReflectionFunction('bazzerBazFoo'), # Fails
#        new ReflectionMethod(Text::class, '__toString'), # Fails
#        ReflectionReference::fromArrayElement(['foo'], 0), # Fails
#        # NOT TESTED YET: new ReflectionAttribute(), # Fails
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

