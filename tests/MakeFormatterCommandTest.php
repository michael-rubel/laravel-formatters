<?php

namespace MichaelRubel\Formatters\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use MichaelRubel\Formatters\Commands\MakeFormatterCommand;
use MichaelRubel\Formatters\FormatterService;
use MichaelRubel\Formatters\FormatterServiceProvider;
use Symfony\Component\Console\Input\InputOption;

class MakeFormatterCommandTest extends TestCase
{
    public function testCanMakeFormatter()
    {
        config([
            'formatters.folder' => app_path('Formatters'),
        ]);

        File::deleteDirectory(config('formatters.folder'));

        app()->register(FormatterServiceProvider::class, true);

        $this->artisan('make:formatter', [
            'name' => 'TestFormatter',
        ]);

        $pathToGeneratedFile = app_path('Formatters' . DIRECTORY_SEPARATOR . 'TestFormatter.php');

        $this->assertFileExists($pathToGeneratedFile);

        $fileString = File::get($pathToGeneratedFile);

        $this->assertStringContainsString('declare(strict_types=1);', $fileString);
        $this->assertStringContainsString('MichaelRubel\Formatters\Formatter', $fileString);
        $this->assertStringContainsString('class TestFormatter implements Formatter', $fileString);
        $this->assertStringContainsString('public function format(): ?string', $fileString);
    }

    public function testFormatterCommandOptions()
    {
        $option = app(MakeFormatterCommand::class)
            ->getNativeDefinition()
            ->getOption('formatter');

        $fakeOption = new InputOption('formatter', null, InputOption::VALUE_NONE, 'Create the formatter class');

        $this->assertEquals($option, $fakeOption);
    }
}
