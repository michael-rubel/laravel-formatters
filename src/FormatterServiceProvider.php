<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use MichaelRubel\Formatters\Commands\MakeFormatterCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Symfony\Component\Finder\SplFileInfo;

class FormatterServiceProvider extends PackageServiceProvider
{
    /**
     * Configure the package.
     *
     * @param  Package  $package
     *
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-formatters')
            ->hasConfigFile()
            ->hasCommand(MakeFormatterCommand::class);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function packageRegistered(): void
    {
        /** @var string $app_folder */
        $app_folder = config('formatters.folder');

        if (empty($app_folder)) {
            return;
        }

        /** @var string $bindings_case */
        $bindings_case = config('formatters.bindings_case', 'kebab');

        $filesystem = app('files');

        $appFormatters = $filesystem->isDirectory(base_path($app_folder))
            ? collect($filesystem->allFiles(base_path($app_folder)))
            : new Collection;

        $packageFormatters = collect(
            $filesystem->allFiles($this->getPackageDirectory())
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
     * Get the package directory path.
     *
     * @return string
     */
    private function getPackageDirectory(): string
    {
        return $this->getPackageBaseDir() . DIRECTORY_SEPARATOR . FormatterService::PACKAGE_FOLDER;
    }

    /**
     * Returns formatter name for string binding.
     *
     * @param  string  $bindings_case
     * @param  string  $filename
     *
     * @return string
     */
    private function getFormatterName(string $bindings_case, string $filename): string
    {
        $name = str_replace('Formatter', '', $filename);

        return Str::{$bindings_case}($name . FormatterService::BINDING_POSTFIX);
    }

    /**
     * Determines the formatter class namespace.
     *
     * @param  SplFileInfo  $file
     * @param  string  $filename
     * @param  string  $app_folder
     *
     * @return string
     */
    private function getFormatterClass(SplFileInfo $file, string $filename, string $app_folder): string
    {
        $path = str_contains($file->getPathName(), $app_folder)
            ? Str::ucfirst(str_replace(DIRECTORY_SEPARATOR, FormatterService::CLASS_SEPARATOR, $app_folder))
                . FormatterService::CLASS_SEPARATOR
            : (new \ReflectionClass(static::class))->getNamespaceName()
              . FormatterService::CLASS_SEPARATOR
              . FormatterService::PACKAGE_FOLDER
              . FormatterService::CLASS_SEPARATOR;

        return sprintf('%s%s', $path, $filename);
    }
}
