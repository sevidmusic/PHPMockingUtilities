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

// example output:
array(0) {
}

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockBool

Can be used to mock the boolean value false.

Example:

```
<?php

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

// example output:
bool(false)

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockClassInstance

Can be used to mock an instance of an existing class.

Can also be used to mock argument values for methods defined
by an existing class.

Example:

```
<?php

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


// example output:
class Darling\PHPTextTypes\classes\strings\Id#7 (2) {
  private string $string =>
  string(63) "UauDDaglHG5tqF7hTQCiKuy32nsVe7k9d0qBcIoW09RF1pyNT4wSIbWnad83Nix"
  private Darling\PHPTextTypes\interfaces\strings\Text $text =>
  class Darling\PHPTextTypes\classes\strings\AlphanumericText#6 (2) {
    private string $string =>
    string(63) "UauDDaglHG5tqF7hTQCiKuy32nsVe7k9d0qBcIoW09RF1pyNT4wSIbWnad83Nix"
    private Darling\PHPTextTypes\interfaces\strings\Text $text =>
    class Darling\PHPTextTypes\classes\strings\Text#8 (1) {
      private string $string =>
      string(63) "UauDDaglHG5tqF7hTQCiKuy32nsVe7k9d0qBcIoW09RF1pyNT4wSIbWnad83Nix"
    }
  }
}

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockClosure

Can be used to mock a closure.

Example:

```
<?php

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

// example output:
class Closure#2 (1) {
  virtual $closure =>
  "$this->Darling\PHPMockingUtilities\classes\mock\values\{closure}"
  public $this =>
  class Darling\PHPMockingUtilities\classes\mock\values\MockClosure#3 (0) {
  }
}


```

### \Darling\PHPMockingUtilities\classes\mock\values\MockFloat

Can be used to mock a float.

Example:

```
<?php

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

// example output:
double(394703.8)

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockInt

Can be used to mock a int.

Example:

```
<?php

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

// example output:
int(5360127692240532047)

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue

Can be used to mock a mixed value.

Example:

```
<?php

require_once(
    __DIR__ .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPMockingUtilities\classes\mock\values\MockMixedValue;

$mockMixedValue = new MockMixedValue1();

var_dump($mockMixedValue1->value());

// example output:
string(62) "b7i0Doje1VuIXJsy4TkvMA5L3QhxqNHUmr9tSPOzfnRd8WEBc6Flw2CgGaZpYK"

$mockMixedValue2 = new MockMixedValue();

var_dump($mockMixedValue2->value());

// example output
class Darling\PHPTextTypes\classes\strings\Text#5 (1) {
  private string $string =>
  string(14) "MockMixedValue"
}

```

### \Darling\PHPMockingUtilities\classes\mock\values\MockString

Can be used to mock a string.

Example:

```
<?php

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

// example output:

string(49) "MockStringCwnmRNocnGdY2O3TLudxVHbJIZ0EzbJEXKxB743"

```


