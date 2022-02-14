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
        return $this->resolveStubPath('/stubs/formatter.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param string $stub
     *
     * @return string
     */
    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath // @codeCoverageIgnore
            : __DIR__ . $stub;
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
