<?php

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\FormatterServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            FormatterServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('testing');
    }

    public function trimNarrowNoBreakSpace(string $input): string
    {
        return preg_replace(
            '/\s+/',
            ' ',
            preg_replace(
                '/[^0-9,\-]/',
                ' ',
                $input
            )
        );
    }
}
