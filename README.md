# PolyCast

[![Build Status](https://travis-ci.org/theodorejb/PolyCast.svg?branch=master)](https://travis-ci.org/theodorejb/PolyCast) [![Packagist Version](https://img.shields.io/packagist/v/theodorejb/polycast.svg)](https://packagist.org/packages/theodorejb/polycast) [![License](https://img.shields.io/packagist/l/theodorejb/polycast.svg)](LICENSE.md)

Adds `to_int`, `to_float`, and `to_string` functions for safe, strict casting. The functions return `false` if a value cannot be safely cast.

Based on https://github.com/TazeTSchnitzel/php-src/compare/php:master...TazeTSchnitzel:safe_casts.

## Installation

To install via [Composer](https://getcomposer.org/), add the following to the composer.json file in your project root:

```json
{
    "require": {
        "theodorejb/polycast": "~0.3"
    }
}
```

Then run `composer install` and require `vendor/autoload.php` in your application's bootstrap file.

## Examples

```php

// passing a resource, array, bool, or null value to
// any of the three functions will always return false
to_*(null);      // false
to_*(true);      // false
to_*(false);     // false
to_*([]);        // false
to_*($resource); // false

to_int("0");     // 0
to_int(0);       // 0
to_int(0.0);     // 0
to_int("10");    // 10
to_int(10);      // 10
to_int(10.0);    // 10
to_int(" 100 "); // 100
to_int("10abc");        // false
to_int("31e+7");        // false
to_int("10.0");         // false
to_int(1.5);            // false
to_int("1.5");          // false
to_int(INF);            // false
to_int(NAN);            // false
to_int(new stdClass()); // false

to_float("0");     // 0.0
to_float(0);       // 0.0
to_float(0.0);     // 0.0
to_float("10");    // 10.0
to_float(10);      // 10.0
to_float(10.0);    // 10.0
to_float(1.5);     // 1.5
to_float("1.5");   // 1.5
to_float(INF);     // INF
to_float(NAN);     // NAN
to_float("75e-5"); // 0.00075
to_float(" 100 "); // 100.0
to_float("10abc");        // false
to_float(new stdClass()); // false

to_string("foobar"); // "foobar"
to_string(123);      // "123"
to_string(123.45);   // "123.45"
to_string(INF);      // "INF"
to_string(NAN);      // "NAN"

class NotStringable {}
class Stringable {
    public function __toString() {
        return "foobar";
    }
}

to_string(new stdClass());      // false
to_string(new NotStringable()); // false
to_string(new Stringable());    // "foobar"
```

## Author

Theodore Brown  
<http://theodorejb.me>

## License

MIT
