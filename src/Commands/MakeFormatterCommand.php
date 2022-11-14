<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeFormatterCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:formatter';

    /**
     * @var string
     */
    protected $description = 'Create the formatter class';

    /**
     * @var string
     */
    protected $type = 'Formatter';

    /**
     * Specify your Stub's location.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return file_exists($customPath = $this->laravel->basePath('/stubs/formatter.stub'))
            ? $customPath // @codeCoverageIgnore
            : __DIR__ . '/stubs/formatter.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\\Formatters';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            ['formatter', null, InputOption::VALUE_NONE, 'Create the formatter class'],
        ];
    }
}
