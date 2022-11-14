<?php

namespace MichaelRubel\Formatters\Tests;

use Illuminate\Support\Facades\File;
use MichaelRubel\Formatters\Collection\DateFormatter;
use MichaelRubel\Formatters\Exceptions\ShouldNotUseCamelCaseException;
use MichaelRubel\Formatters\FormatterServiceProvider;
use ReflectionFunction;

class FormatterBindingsTest extends TestCase
{
    /** @test */
    public function testStringBindingsWorksProperly()
    {
        config(['formatters.bindings_case' => 'snake']);

        app()->register(FormatterServiceProvider::class, true);
        app()->bind('date_formatter', DateFormatter::class);

        $result = format('date', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30', $result);

        $result = format('date_time', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30 17:00', $result);

        $result = format('table_column', 'created_at');
        $this->assertEquals('Created at', $result);
    }

    /** @test */
    public function testFormatterFromAppFolderLoadsCorrectly()
    {
        $this->artisan('make:formatter', [
            'name' => 'TestFormatter',
        ]);

        app()->register(FormatterServiceProvider::class, true);

        $binding = app()->getBindings()['test_formatter']['concrete'];

        $this->assertTrue(isset($binding));
        $this->assertSame([
            'abstract' => 'test_formatter',
            'concrete' => 'App\Formatters\TestFormatter',
        ], (new ReflectionFunction($binding))->getStaticVariables());

        File::delete(app_path('Formatters' . DIRECTORY_SEPARATOR . 'TestFormatter.php'));
    }

    /** @test */
    public function testStringBindingsWithSetKebabCase()
    {
        config(['formatters.bindings_case' => 'kebab']);

        app()->register(FormatterServiceProvider::class, true);
        app()->bind('date_formatter', DateFormatter::class);

        $result = format('date', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30', $result);

        $result = format('date-time', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30 17:00', $result);

        $result = format('table-column', 'created_at');
        $this->assertEquals('Created at', $result);
    }

    /** @test */
    public function testStringBindingsWithCamelCaseIsForbidden()
    {
        $this->expectException(ShouldNotUseCamelCaseException::class);

        config(['formatters.bindings_case' => 'camel']);

        app()->register(FormatterServiceProvider::class, true);

        format('datetime', '2021-10-30 17:00:00');
    }
}
