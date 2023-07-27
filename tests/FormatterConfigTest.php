<?php

declare(strict_types=1);

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

        $registered = app()->register(FormatterServiceProvider::class, true);

        $this->assertInstanceOf(FormatterServiceProvider::class, $registered);
    }

    /** @test */
    public function testPackageDoesntFailWhenConfigHasNulls()
    {
        config([
            'formatters.folder'        => null,
            'formatters.bindings_case' => null,
        ]);

        $registered = app()->register(FormatterServiceProvider::class, true);
        $this->assertInstanceOf(FormatterServiceProvider::class, $registered);
    }

    /** @test */
    public function testPackageDoesntFailWhenWrongFolder()
    {
        config([
            'formatters.folder' => DIRECTORY_SEPARATOR . 'app' . 'Formatters',
        ]);

        $this->artisan('make:formatter', ['name' => 'TestFormatter']);
        $registered = app()->register(FormatterServiceProvider::class, true);
        $this->assertInstanceOf(FormatterServiceProvider::class, $registered);
    }

    /** @test */
    public function testPackageDoesntFailWhenWrongFolderSecondCombination()
    {
        config([
            'formatters.folder' => DIRECTORY_SEPARATOR . 'Formatters',
        ]);

        $this->artisan('make:formatter', ['name' => 'TestFormatter']);
        $registered = app()->register(FormatterServiceProvider::class, true);
        $this->assertInstanceOf(FormatterServiceProvider::class, $registered);
    }

    /** @test */
    public function testPackageDoesntFailWhenWrongFolderThirdCombination()
    {
        config([
            'formatters.folder' => 'app' . 'Formatters',
        ]);

        $this->artisan('make:formatter', ['name' => 'TestFormatter']);
        $registered = app()->register(FormatterServiceProvider::class, true);
        $this->assertInstanceOf(FormatterServiceProvider::class, $registered);
    }

    /** @test */
    public function testPackageDoesntFailWhenWrongFolderFourthCombination()
    {
        config([
            'formatters.folder' => 'app' . 'Formatters' . DIRECTORY_SEPARATOR,
        ]);

        $this->artisan('make:formatter', ['name' => 'TestFormatter']);
        $registered = app()->register(FormatterServiceProvider::class, true);
        $this->assertInstanceOf(FormatterServiceProvider::class, $registered);
    }
}
