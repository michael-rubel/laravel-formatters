![Laravel Formatters](https://user-images.githubusercontent.com/37669560/139543664-89e5c4ed-0648-40c9-bccf-18e42ae4c2d0.png)

# Laravel Formatters
[![Latest Version on Packagist](https://img.shields.io/packagist/v/michael-rubel/laravel-formatters.svg?style=flat-square&logo=packagist)](https://packagist.org/packages/michael-rubel/laravel-formatters)
[![Total Downloads](https://img.shields.io/packagist/dt/michael-rubel/laravel-formatters.svg?style=flat-square&logo=packagist)](https://packagist.org/packages/michael-rubel/laravel-formatters)
[![Code Quality](https://img.shields.io/scrutinizer/quality/g/michael-rubel/laravel-formatters.svg?style=flat-square&logo=scrutinizer)](https://scrutinizer-ci.com/g/michael-rubel/laravel-formatters/?branch=main)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/michael-rubel/laravel-formatters.svg?style=flat-square&logo=scrutinizer)](https://scrutinizer-ci.com/g/michael-rubel/laravel-formatters/?branch=main)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/michael-rubel/laravel-formatters/run-tests/main?style=flat-square&label=tests&logo=github)](https://github.com/michael-rubel/laravel-formatters/actions)
[![PHPStan](https://img.shields.io/github/workflow/status/michael-rubel/laravel-formatters/phpstan/main?style=flat-square&label=larastan&logo=laravel)](https://github.com/michael-rubel/laravel-formatters/actions)


This package is a collection of classes you can use to standardize data formats in your Laravel application.
It uses the Service Container to easily extend or override the formatter classes.

The package requires PHP `^8.x` and Laravel `^8.69`.

[![PHP Version](https://img.shields.io/badge/php-^8.x-777BB4?style=flat-square&logo=php)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/laravel-^8.x-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![Laravel Octane Compatible](https://img.shields.io/badge/octane-compatible-success?style=flat-square&logo=laravel)](https://github.com/laravel/octane)

## Available formatters
- [`Date`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/DateFormatter.php)
- [`DateTime`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/DateTimeFormatter.php)
- [`TableColumn`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/TableColumnFormatter.php)
- [`LocaleNumber`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/LocaleNumberFormatter.php)

... Will be more formatters soon. 😉

## Contributing
If you have written your own formatter and want to add it to this package, PRs are welcomed.
- Note: PRs won't be accepted without tests! We're always covering the code to 100%.

## Installation
You can install the package via composer:

```bash
composer require michael-rubel/laravel-formatters
```

## Usage

```php
format(DateTimeFormatter::class, now()) // You can use Carbon instance or string timestamp.
```

You can use string bindings:
```php
format('table-column', 'created_at') // Returns: Created at
```

You can configure the string bindings case (snake/kebab) in the config file:
```bash
php artisan vendor:publish --tag="formatters-config"
```

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
