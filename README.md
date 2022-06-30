![Laravel Formatters](https://user-images.githubusercontent.com/37669560/176375794-5588c598-858a-4fd7-a182-7094e219c788.png)

# Laravel Formatters
[![Latest Version on Packagist](https://img.shields.io/packagist/v/michael-rubel/laravel-formatters.svg?style=flat-square&logo=packagist)](https://packagist.org/packages/michael-rubel/laravel-formatters)
[![Total Downloads](https://img.shields.io/packagist/dt/michael-rubel/laravel-formatters.svg?style=flat-square&logo=packagist)](https://packagist.org/packages/michael-rubel/laravel-formatters)
[![Code Quality](https://img.shields.io/scrutinizer/quality/g/michael-rubel/laravel-formatters.svg?style=flat-square&logo=scrutinizer)](https://scrutinizer-ci.com/g/michael-rubel/laravel-formatters/?branch=main)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/michael-rubel/laravel-formatters.svg?style=flat-square&logo=scrutinizer)](https://scrutinizer-ci.com/g/michael-rubel/laravel-formatters/?branch=main)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/michael-rubel/laravel-formatters/run-tests/main?style=flat-square&label=tests&logo=github)](https://github.com/michael-rubel/laravel-formatters/actions)
[![PHPStan](https://img.shields.io/github/workflow/status/michael-rubel/laravel-formatters/phpstan/main?style=flat-square&label=larastan&logo=laravel)](https://github.com/michael-rubel/laravel-formatters/actions)

This package introduces the `Formatter` pattern you can use to standardize data formats in your Laravel application. You can write your own formatters and put them in `app/Formatters` folder, then apply them everywhere in your application through `format` helper. The package uses the Service Container under the hood to easily extend or override the formatter classes.

---

The package requires PHP `^8.x` and Laravel `^8.71` or `^9.0`.

## #StandWithUkraine
[![SWUbanner](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/banner2-direct.svg)](https://github.com/vshymanskyy/StandWithUkraine/blob/main/docs/README.md)

## Installation

Install the package via composer:
```bash
composer require michael-rubel/laravel-formatters
```

```bash
php artisan vendor:publish --tag="formatters-config"
```


## Usage

```php
format(DateTimeFormatter::class, now());
```

You can use a shorter version of the string as an alternative:
```php
format('date-time', now());
```

## Available built-in formatters
- [`Date`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/DateFormatter.php)
- [`DateTime`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/DateTimeFormatter.php)
- [`LocaleNumber`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/LocaleNumberFormatter.php)
- [`MaskString`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/MaskStringFormatter.php)
- [`TableColumn`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/TableColumnFormatter.php)
- [`TaxNumber`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/TaxNumberFormatter.php)

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

### Adding custom/overriding package formatters
To add a custom formatter you should create the class that implements the `MichaelRubel\Formatters\Formatter` interface and put it to the `app/Formatters` folder.
You can put formatter with the same name as the package's to override the formatter from the package. You can customize the folder in the config file.

### Examples
You can discover examples of the usage [here](https://github.com/michael-rubel/laravel-formatters/blob/main/docs/examples.md).

## Contributing
If you have written your own formatter and want to add it to this package, PRs are welcomed. But take care of the extendability of the formatter you want to make as built-in and remember to write tests for your use cases.

## Testing
```bash
composer test
```
