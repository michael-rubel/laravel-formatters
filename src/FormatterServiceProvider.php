<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters;

use Illuminate\Support\Str;
use MichaelRubel\Formatters\Exceptions\ShouldImplementInterfaceException;
use MichaelRubel\Formatters\Exceptions\ShouldNotUseCamelCaseException;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FormatterServiceProvider extends PackageServiceProvider
{
    /**
     * Internal constants.
     *
     * @const
     */
    public const PACKAGE_FOLDER  = 'Collection';
    public const PACKAGE_CLASS   = 'Formatter';
    public const BINDING_POSTFIX = '_formatter';
    public const CLASS_SEPARATOR = '\\';

    /**
     * Configure the package.
     *
     * @param Package $package
     *
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-formatters')
            ->hasConfigFile();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function packageRegistered(): void
    {
        $app_folder = config('formatters.folder')
            ?? 'app' . DIRECTORY_SEPARATOR . 'Formatters';

        $bindings_case = config('formatters.bindings_case')
            ?? 'kebab';

        $filesystem = app('files');

        $appFormatters = $filesystem->isDirectory($app_folder)
            ? collect($filesystem->allFiles($app_folder))
            : collect();

        $packageFormatters = collect(
            $filesystem->allFiles(
                $this->getPackageBaseDir()
                . DIRECTORY_SEPARATOR
                . self::PACKAGE_FOLDER
            )
        );

        $packageFormatters
            ->merge($appFormatters)
            ->each(function ($file) use ($app_folder, $bindings_case) {
                $filename = $file->getFilenameWithoutExtension();
                $name     = $this->getFormatterName($bindings_case, $filename);
                $class    = $this->getFormatterClass($file, $filename, $app_folder);

                $this->app->bind($name, $class);
            });
    }

    /**
     * Returns formatter name for string binding.
     *
     * @param string $bindings_case
     * @param string $filename
     *
     * @return string
     */
    public function getFormatterName(string $bindings_case, string $filename): string
    {
        $name = str_replace('Formatter', '', $filename);

        return Str::{$bindings_case}($name . self::BINDING_POSTFIX);
    }

    /**
     * Determines the formatter class namespace.
     *
     * @param object $file
     * @param string $filename
     * @param string $app_folder
     *
     * @return string
     */
    private function getFormatterClass(object $file, string $filename, string $app_folder): string
    {
        $path = str_contains($file->getPathName(), $app_folder)
            ? Str::ucfirst(str_replace(DIRECTORY_SEPARATOR, self::CLASS_SEPARATOR, $app_folder))
              . self::CLASS_SEPARATOR
            : (new \ReflectionClass(static::class))->getNamespaceName()
              . self::CLASS_SEPARATOR
              . self::PACKAGE_FOLDER
              . self::CLASS_SEPARATOR;

        return sprintf('%s%s', $path, $filename);
    }

    /**
     * Ensures all the formatters will implement the same interface.
     *
     * @param object $formatter
     */
    public static function ensureFormatterImplementsInterface(object $formatter): void
    {
        if (! $formatter instanceof Formatter) {
            if (config('formatters.bindings_case') === 'camel') {
                throw new ShouldNotUseCamelCaseException();
            }

            throw new ShouldImplementInterfaceException();
        }
    }
}
