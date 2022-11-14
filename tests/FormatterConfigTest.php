<?php

namespace MichaelRubel\Formatters\Tests;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Log;
use MichaelRubel\Formatters\FormatterService;
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

        $registered = app()->register(FormatterServiceProvider::class, true);

        $this->assertInstanceOf(FormatterServiceProvider::class, $registered);
    }

    /** @test */
    public function testPackageFailsWhenConfigHasNulls()
    {
        $this->expectException(\Exception::class);

        config([
            'formatters.folder'        => null,
            'formatters.bindings_case' => null,
        ]);

        app()->register(FormatterServiceProvider::class, true);
    }

    /** @test */
    public function testPackageDoesntFailWhenWrongFolder()
    {
        config([
            'formatters.folder' => DIRECTORY_SEPARATOR . 'app' . 'Formatters',
        ]);

        $this->artisan('make:formatter', ['name' => 'TestFormatter']);
        app()->register(FormatterServiceProvider::class, true);
        $this->assertSame('`Formatters` folder not found.', app(FormatterService::PACKAGE_KEY));
    }

    /** @test */
    public function testPackageDoesntFailWhenWrongFolderSecondCombination()
    {
        config([
            'formatters.folder' => DIRECTORY_SEPARATOR . 'Formatters',
        ]);

        $this->artisan('make:formatter', ['name' => 'TestFormatter']);
        app()->register(FormatterServiceProvider::class, true);
        $this->assertSame('`Formatters` folder not found.', app(FormatterService::PACKAGE_KEY));
    }

    /** @test */
    public function testPackageDoesntFailWhenWrongFolderThirdCombination()
    {
        config([
            'formatters.folder' => 'app' . 'Formatters',
        ]);

        $this->artisan('make:formatter', ['name' => 'TestFormatter']);
        app()->register(FormatterServiceProvider::class, true);
        $this->assertSame('`Formatters` folder not found.', app(FormatterService::PACKAGE_KEY));
    }

    /** @test */
    public function testPackageDoesntFailWhenWrongFolderFourthCombination()
    {
        config([
            'formatters.folder' => 'app' . 'Formatters' . DIRECTORY_SEPARATOR,
        ]);

        $this->artisan('make:formatter', ['name' => 'TestFormatter']);
        app()->register(FormatterServiceProvider::class, true);
        $this->assertSame('`Formatters` folder not found.', app(FormatterService::PACKAGE_KEY));
    }
}
