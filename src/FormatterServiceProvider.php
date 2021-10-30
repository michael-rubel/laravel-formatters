<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FormatterServiceProvider extends PackageServiceProvider
{
    /**
     * Internal constants.
     *
     * @const
     */
    public const PACKAGE_FOLDER    = 'Collection';
    public const PACKAGE_NAMESPACE = '\MichaelRubel\Formatters\Collection\\';
    public const FORMATTER_POSTFIX = '_formatter';
    public const CLASS_SEPARATOR   = '\\';

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
    public function packageBooted(): void
    {
        $app_folder = config('formatters.folder');

        $appFormatters = File::isDirectory($app_folder)
            ? collect(File::allFiles($app_folder)) // @codeCoverageIgnore
            : collect();

        $packageFormatters = collect(
            File::allFiles(
                $this->getPackageBaseDir()
                . DIRECTORY_SEPARATOR
                . self::PACKAGE_FOLDER
            )
        );

        $appFormatters
            ->union($packageFormatters)
            ->each(function ($file) use ($app_folder) {
                $filename = $file->getFilenameWithoutExtension();

                $class = $this->getFormatterClass(
                    $file,
                    $filename,
                    $app_folder
                );

                $this->app->bind(
                    Str::snake($filename),
                    $class
                );
            });
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
        // @codeCoverageIgnoreStart
        $path = str_contains($file->getPathName(), $app_folder)
            ? Str::ucfirst(
                str_replace(
                    '/',
                    self::CLASS_SEPARATOR,
                    $app_folder
                )
            ) . self::CLASS_SEPARATOR
            : self::PACKAGE_NAMESPACE;
        // @codeCoverageIgnoreEnd

        return sprintf(
            '%s%s',
            $path,
            $filename
        );
    }
}
