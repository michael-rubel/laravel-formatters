<?php

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\FormatterServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            FormatterServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('testing');
    }

    public function trimSpecialCharacters(string $input): string
    {
        return preg_replace(
            '/\s+/',
            ' ',
            preg_replace(
                '/[^A-Za-z0-9,\-]/',
                ' ',
                $input
            )
        );
    }
}
