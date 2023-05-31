```
 ___ _  _ ___ __  __         _   _           _   _ _   _ _ _ _   _
| _ \ || | _ \  \/  |___  __| |_(_)_ _  __ _| | | | |_(_) (_) |_(_)___ ___
|  _/ __ |  _/ |\/| / _ \/ _| / / | ' \/ _` | |_| |  _| | | |  _| / -_|_-<
|_| |_||_|_| |_|  |_\___/\__|_\_\_|_||_\__, |\___/ \__|_|_|_|\__|_\___/__/
                                       |___/

```

The PHPMockingUtilities library provides classes that can be used to
mock various types of values.

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

# Overview

- [Installation](#installation)
- [Classes](#classes)
    1. [\Darling\PHPMockingUtilities\classes\mock\values\MockArray](#darlingphpmockingutilitiesclassesmockvaluesmockarray)
    2. [\Darling\PHPMockingUtilities\classes\mock\values\MockBool](#darlingphpmockingutilitiesclassesmockvaluesmockbool)
    3. [\Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance](#darlingphpmockingutilitiesclassesmockvaluesmockclassinstance)
    4. [\Darling\PHPMockingUtilities\classes\mock\values\MockClosure](#darlingphpmockingutilitiesclassesmockvaluesmockclosure)
    5. [\Darling\PHPMockingUtilities\classes\mock\values\MockFloat](#darlingphpmockingutilitiesclassesmockvaluesmockfloat)
    6. [\Darling\PHPMockingUtilities\classes\mock\values\MockInt](#darlingphpmockingutilitiesclassesmockvaluesmockint)
    7. [\Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue](#darlingphpmockingutilitiesclassesmockvaluesmockmixedvalue)
    8. [\Darling\PHPMockingUtilities\classes\mock\values\MockString](#darlingphpmockingutilitiesclassesmockvaluesmockstring)

# Installation

```
composer require darling/php-mocking-utilities

```

# Classes

### \Darling\PHPMockingUtilities\classes\mock\values\MockArray

Can be used to mock an empty array.

Example:

```
<?php

/**
 * This file provides examples that demonstrate how to use a MockArray.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockArray;

$mockArray = new MockArray();

var_dump($mockArray->value());

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockBool

Can be used to mock the boolean value false.

Example:

```
<?php

/**
 * This file provides examples that demonstrate how to use a MockBool.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockBool;

$mockBool = new MockBool();

var_dump($mockBool->value());

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance

Can be used to mock an instance of an existing class.

Can also be used to mock argument values for methods defined
by an existing class.

Example:

```
<?php

/**
 * This file provides examples that demonstrate how to use a
 * MockClassInstance.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPReflectionUtilities\classes\utilities\Reflection;


$mockClassInstance = new MockClassInstance(
    new Reflection(new ClassString(Id::class))
);

var_dump($mockClassInstance->mockInstance());

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockClosure

Can be used to mock a closure.

Example:

```
<?php

/**
 * This file provides examples that demonstrate how to use a
 * MockClosure.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockClosure;

$mockClosure = new MockClosure();

var_dump($mockClosure->value());


```

### \Darling\PHPMockingUtilities\classes\mock\values\MockFloat

Can be used to mock a float.

Example:

```
<?php

/**
 * This file provides examples that demonstrate how to use a
 * MockFloat.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockFloat;

$mockFloat = new MockFloat();

var_dump($mockFloat->value());

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockInt

Can be used to mock a int.

Example:

```
<?php

/**
 * This file provides examples that demonstrate how to use a MockInt.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockInt;

$mockInt = new MockInt();

var_dump($mockInt->value());

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue

Can be used to mock a mixed value.

Example:

```
<?php

/**
 * This file provides examples that demonstrate how to use a
 * MockMixedValue.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue;

$mockMixedValue = new MockMixedValue();

var_dump($mockMixedValue->value());

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockString

Can be used to mock a string.

Example:

```
<?php

/**
 * This file provides examples that demonstrate how to use a
 * MockString.
 */

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockString;

$mockString = new MockString();

var_dump($mockString->value());


```


