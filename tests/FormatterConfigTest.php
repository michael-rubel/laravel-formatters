<?php

namespace MichaelRubel\Formatters\Tests;

use Illuminate\Filesystem\Filesystem;
use MichaelRubel\Formatters\FormatterServiceProvider;
use Mockery\MockInterface;

class FormatterConfigTest extends TestCase
{
    /** @test */
    public function testConfigSettingsAndProviderFiles()
    {
        $mock = $this->partialMock(Filesystem::class, function (MockInterface $mock) {
            $mock->shouldReceive('isDirectory')
                 ->once()
                 ->andReturnFalse();
        });

        app()->instance('files', $mock);

        config([
            'formatters.folder'        => null,
            'formatters.bindings_case' => null,
        ]);

        $registered = app()->register(FormatterServiceProvider::class, true);

        $this->assertInstanceOf(FormatterServiceProvider::class, $registered);
    }

    /** @test */
    public function testBaseDirectorySetsCorrectly()
    {
        app()->setBasePath(__DIR__);

        config(['formatters.folder' => 'Formatters']);

        $mock = $this->partialMock(Filesystem::class, function (MockInterface $mock) {
            $mock->shouldReceive('isDirectory')
                 ->once()
                 ->andReturnTrue();
        });

        app()->instance('files', $mock);

        $registered = app()->register(FormatterServiceProvider::class, true);

        $this->assertInstanceOf(FormatterServiceProvider::class, $registered);
    }
}
