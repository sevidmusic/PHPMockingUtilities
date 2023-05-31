```
 ___ _  _ ___ __  __         _   _           _   _ _   _ _ _ _   _
| _ \ || | _ \  \/  |___  __| |_(_)_ _  __ _| | | | |_(_) (_) |_(_)___ ___
|  _/ __ |  _/ |\/| / _ \/ _| / / | ' \/ _` | |_| |  _| | | |  _| / -_|_-<
|_| |_||_|_| |_|  |_\___/\__|_\_\_|_||_\__, |\___/ \__|_|_|_|\__|_\___/__/
                                       |___/

```

The PHPMockingUtilities library provides classes that can be used to mock various types of values.

The following classes are provided by this library:

```
\Darling\PHPMockingUtilities\classes\mock\values\MockArray

\Darling\PHPMockingUtilities\classes\mock\values\MockBool

\Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance

\Darling\PHPMockingUtilities\classes\mock\values\MockClosure

\Darling\PHPMockingUtilities\classes\mock\values\MockFloat

\Darling\PHPMockingUtilities\classes\mock\values\MockInt

\Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue

\Darling\PHPMockingUtilities\classes\mock\values\MockString

```

# Installation

```
composer require darling/php-mocking-utilities

```

# Classes

### \Darling\PHPMockingUtilities\classes\mock\values\MockArray

Can be used to mock an empty array.

Example:

```
var_dump($mockArray->value());

// example output:
array(0) {
}

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockBool

Can be used to mock the boolean value false.

Example:

```
var_dump($mockBool->value());

// example output:
bool(false)

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance

Can be used to mock an instance of an existing class.

Can also be used to mock argument values for methods defined
by an existing class.

Example:

```
var_dump($mocker->reflection()->type()->__toString());

// example output:
string(8) "stdClass"

$mockInstance = $mocker->mockInstance();

var_dump($mockInstance);

// example output:
class stdClass#38 (0) {
}

var_dump($mocker->mockMethodArguments('__construct'));

// example output:
array(0) {
}

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockClosure

### \Darling\PHPMockingUtilities\classes\mock\values\MockFloat

### \Darling\PHPMockingUtilities\classes\mock\values\MockInt

### \Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue

### \Darling\PHPMockingUtilities\classes\mock\values\MockString


