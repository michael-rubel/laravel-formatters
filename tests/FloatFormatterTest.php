<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Collection\FloatFormatter;

class FloatFormatterTest extends TestCase
{
    /** @test */
    public function testCanFormatUsingFirstParameter()
    {
        $result = format('float', '10,000.00');

        $this->assertSame(10000.00, $result);
    }

    /** @test */
    public function testFormatBehaviorWithNullOrEmpty()
    {
        $format = format('float');
        $this->assertSame(0.00, $format);

        $format = format('float', '');
        $this->assertSame(0.00, $format);

        $format = format('float', null);
        $this->assertSame(0.00, $format);
    }

    /** @test */
    public function testCanFormatUsingStringBinding()
    {
        $result = format('float', ['value' => '123,45', 'decimal_separator' => '.']);

        $this->assertSame(12345.0, $result);
    }

    /** @test */
    public function testCanFormatUsingNamedArguments()
    {
        $result = format(
            formatter: FloatFormatter::class,
            value: 10000,
        );

        $this->assertSame(10000.00, $result);
    }

    /** @test */
    public function testCanSetDecimalSeparatorUsingExtend()
    {
        $this->app->extend(FloatFormatter::class, function (FloatFormatter $formatter) {
            $formatter->decimal_separator = ',';

            return $formatter;
        });

        $result = format(FloatFormatter::class, '100,55');

        $this->assertEquals(100.55, $result);
    }
}
