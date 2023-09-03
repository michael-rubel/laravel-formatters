<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Collection\IntFormatter;

class IntFormatterTest extends TestCase
{
    /** @test */
    public function testCanFormatUsingFirstParameter()
    {
        $result = format('int', '10,000.00');

        $this->assertSame(10000, $result);
    }

    /** @test */
    public function testFormatBehaviorWithNullOrEmpty()
    {
        $format = format('int');
        $this->assertSame(0, $format);

        $format = format('int', '');
        $this->assertSame(0, $format);

        $format = format('int', null);
        $this->assertSame(0, $format);
    }

    /** @test */
    public function testCanFormatUsingStringBinding()
    {
        $result = format('int', ['value' => '123,45', 'decimal_separator' => '.']);

        $this->assertSame(12345, $result);
    }

    /** @test */
    public function testCanFormatUsingNamedArguments()
    {
        $result = format(
            formatter: IntFormatter::class,
            value: 10000.00,
        );

        $this->assertSame(10000, $result);
    }

    /** @test */
    public function testCanSetDecimalSeparatorUsingExtend()
    {
        $this->app->extend(IntFormatter::class, function (IntFormatter $formatter) {
            $formatter->decimal_separator = ',';

            return $formatter;
        });

        $result = format(IntFormatter::class, '100,55');

        $this->assertEquals(100, $result);
    }
}
