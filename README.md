# din-validator - DIN Validator
Library to validate if strings meet specific DIN Specifications.

## Contents
 - [Requirements](#requirements)
 - [Install](#install)
 - [Usage](#usage)
 - [Development](#development)
 - [Testing](#testing)

## Requirements <a id="requirements" href="#requirements">#</a>

 - PHP >= 7.4
 
## Install <a id="install" href="#install">#</a>

```shell
composer require lupuscoding/din-validator
```

## Usage <a id="usage" href="#usage">#</a>

To validate a string for a certain DIN specification, it is recommended to use
the static ValidatorFactory methods.

For example: We want to validate an user input for DIN SPEC 91379
```php
function testUserInput(string $input) {
    // do some stuff
    if (!LupusCoding\DinValidator\ValidatorFactory::validateDinSpec91379($input)) {
        // do something if input is not valid
    }
    // do other stuff
}
```

You are also able to use specific tests, if you need more detailed information.
The majority validator methods of this library should work on basis of a 
single character. Because of this, you should be able to test single characters
if they are part of the specification. For this, initialize the class, related
to the required specification (src/Specs/) and search for a method to fit your
needs.

## Development <a id="development" href="#development">#</a>

* Every contribution should respect PSR-2 and PSR-12.
* Methods must provide argument types and return types.
* Class properties must be typed.
* doc blocks must only contain descriptive information.
* doc blocks may additionally contain a type declaration for arguments or
  return values, if the type declaration is not precise.

For example: ```func(): array``` may not be precise if the method returns
an array of arrays or objects. Consider a doc block entry like
```@return array[]``` or ```@return MyObject[]``` for clarification.

## Testing <a id="testing" href="#testing">#</a>

First install **phpunit** by executing
```shell
composer install
```
Then start phpunit by executing
```shell
vendor/bin/phpunit
```