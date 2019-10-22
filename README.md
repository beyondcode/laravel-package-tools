# Laravel Package Tools

[![Latest Version on Packagist](https://img.shields.io/packagist/v/beyondcode/laravel-package-tools.svg?style=flat-square)](https://packagist.org/packages/beyondcode/laravel-package-tools)
[![Build Status](https://img.shields.io/travis/beyondcode/laravel-package-tools/master.svg?style=flat-square)](https://travis-ci.org/beyondcode/laravel-package-tools)
[![Quality Score](https://img.shields.io/scrutinizer/g/beyondcode/laravel-package-tools.svg?style=flat-square)](https://scrutinizer-ci.com/g/beyondcode/laravel-package-tools)
[![Total Downloads](https://img.shields.io/packagist/dt/beyondcode/laravel-package-tools.svg?style=flat-square)](https://packagist.org/packages/beyondcode/laravel-package-tools)

Gives you the `make:` commands that you know and love from Laravel - outside of Laravel. Ready to use in your next package.

[![https://phppackagedevelopment.com](https://phppackagedevelopment.com/img/twitter-card_package_dev.png)](https://phppackagedevelopment.com)

If you want to learn how to create reusable PHP packages yourself, take a look at my upcoming [PHP Package Development](https://phppackagedevelopment.com) video course.


## Installation

You can install the package via composer:

```bash
composer require --dev beyondcode/laravel-package-tools
```

## Usage

You can use this package from the root of the package that you are developing. You can use the `pkg-tools` binary to create and scaffold new classes.

The package will automatically detect your namespace from your `composer.json` autoload configuration and apply it to the generated files.

## Available commands

```
./vendor/bin/pkg-tools make:command name [--command=] [--force]

./vendor/bin/pkg-tools make:request name [--force]

./vendor/bin/pkg-tools make:job name [--sync] [--force]

./vendor/bin/pkg-tools make:event name [--force]

./vendor/bin/pkg-tools make:notification name [--force]

./vendor/bin/pkg-tools make:rule name [--force]

./vendor/bin/pkg-tools make:migration name [--create=] [--force]

./vendor/bin/pkg-tools make:factory name [--model=] [--force]

./vendor/bin/pkg-tools make:model name [--m|migration] [--f|factory] [--force]
``` 

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email marcel@beyondco.de instead of using the issue tracker.

## Credits

- [Marcel Pociot](https://github.com/beyondcode)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).