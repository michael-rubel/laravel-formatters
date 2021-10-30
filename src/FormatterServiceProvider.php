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
    public const PACKAGE_FOLDER = 'Collection';
    public const PACKAGE_NAMESPACE = '\MichaelRubel\Formatters\Collection\\';
    public const FORMATTER_POSTFIX = '_formatter';

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
        $appFolder = config('formatters.folder');

        $appFormatters = File::isDirectory($appFolder)
            ? collect(File::allFiles($appFolder)) // @codeCoverageIgnore
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
            ->each(function ($file) {
                $filename = $file->getFilenameWithoutExtension();

                $class = sprintf(
                    '%s%s',
                    self::PACKAGE_NAMESPACE,
                    $filename
                );

                $this->app->bind(
                    Str::snake($filename),
                    $class
                );
            });
    }
}
