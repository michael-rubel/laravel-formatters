<?php

namespace MichaelRubel\Formatters\Tests;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use MichaelRubel\Formatters\FormatterServiceProvider;
use Mockery\MockInterface;

class MakeFormatterCommandTest extends TestCase
{
    /** @test */
    public function testCanMakeFormatter()
    {
        $this->artisan('make:formatter', ['name' => 'TestFormatter']);

        $this->assertFileExists(
            app_path('Formatters' . DIRECTORY_SEPARATOR . 'TestFormatter.php')
        );
    }
}
