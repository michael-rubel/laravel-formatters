![Laravel Formatters](https://user-images.githubusercontent.com/37669560/146684668-4c901349-dac7-49b8-b34a-29fdab108ded.png)

# Laravel Formatters
[![Latest Version on Packagist](https://img.shields.io/packagist/v/michael-rubel/laravel-formatters.svg?style=flat-square&logo=packagist)](https://packagist.org/packages/michael-rubel/laravel-formatters)
[![Total Downloads](https://img.shields.io/packagist/dt/michael-rubel/laravel-formatters.svg?style=flat-square&logo=packagist)](https://packagist.org/packages/michael-rubel/laravel-formatters)
[![Code Quality](https://img.shields.io/scrutinizer/quality/g/michael-rubel/laravel-formatters.svg?style=flat-square&logo=scrutinizer)](https://scrutinizer-ci.com/g/michael-rubel/laravel-formatters/?branch=main)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/michael-rubel/laravel-formatters.svg?style=flat-square&logo=scrutinizer)](https://scrutinizer-ci.com/g/michael-rubel/laravel-formatters/?branch=main)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/michael-rubel/laravel-formatters/run-tests/main?style=flat-square&label=tests&logo=github)](https://github.com/michael-rubel/laravel-formatters/actions)
[![PHPStan](https://img.shields.io/github/workflow/status/michael-rubel/laravel-formatters/phpstan/main?style=flat-square&label=larastan&logo=laravel)](https://github.com/michael-rubel/laravel-formatters/actions)

> This package introduces the `Formatter` pattern you can use to standardize data formats in your Laravel application. You can write your own formatters and put them in `app/Formatters` folder, then apply them everywhere in your application through `format` helper. The package uses the Service Container under the hood to easily extend or override the formatter classes.

The package requires PHP `^8.x` and Laravel `^8.71` or `^9.0`.

## Available built-in formatters
- [`Date`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/DateFormatter.php)
- [`DateTime`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/DateTimeFormatter.php)
- [`LocaleNumber`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/LocaleNumberFormatter.php)
- [`MaskString`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/MaskStringFormatter.php)
- [`TableColumn`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/TableColumnFormatter.php)
- [`TaxNumber`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/TaxNumberFormatter.php)

## Contributing
If you have written your own formatter and want to add it to this package, PRs are welcomed. But take care of the extendability of the formatter you want to make as built-in.
- Note: PRs won't be accepted without tests!

## Installation
You can install the package via composer:

```bash
composer require michael-rubel/laravel-formatters
```

## Usage

```php
format(DateTimeFormatter::class, now())
```

You can use a string binding as an alternative to passing the class:
```php
format('date-time', now())
```

You can configure the string bindings case (snake/kebab) in the config file:
```bash
php artisan vendor:publish --tag="formatters-config"
```

### Artisan command
To make the programmer's life easier, we also added the Artisan command. You can use `make:formatter` command to generate formatter classes. It will put the class with the given name into `app/Formatters` folder and auto-inject the stub.

### Extending formatters
Since the formatters are resolved through the Service Container they can be easily overridden by extending bindings.

For example in your Service Provider:
```php
$this->app->extend(DateTimeFormatter::class, function ($formatter) {
    $formatter->datetime_format = 'Y.m.d H:i';

    return $formatter;
});
```

- Note: You can use [Laravel Enhanced Container](https://github.com/michael-rubel/laravel-enhanced-container) package for shorter extending syntax.

### Adding custom/overriding package formatters
To add a custom formatter you should create the class that implements the `MichaelRubel\Formatters\Formatter` interface and put it to the `app/Formatters` folder.
You can put formatter with the same name as the package's to override the formatter from the package.

You can customize the folder in the config file.

## Testing
```bash
composer test
```
