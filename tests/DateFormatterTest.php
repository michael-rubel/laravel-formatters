<?php

namespace MichaelRubel\Formatters\Tests;

use Carbon\Carbon;
use MichaelRubel\Formatters\Collection\DateFormatter;
use MichaelRubel\Formatters\Exceptions\ShouldImplementInterfaceException;
use MichaelRubel\Formatters\Tests\Boilerplate\WrongFormatter;

class DateFormatterTest extends TestCase
{
    /** @test */
    public function testThrowsExceptionIfWithoutInterface()
    {
        $this->expectException(ShouldImplementInterfaceException::class);

        format(WrongFormatter::class, [
            'test',
        ]);
    }

    /** @test */
    public function testCanFormatDateUsingCarbonInstance()
    {
        Carbon::setTestNow('2021-10-30 14:00:00');

        $result = format(DateFormatter::class, now());
        $this->assertEquals('2021-10-30', $result);

        $result = format(DateFormatter::class, ['to_format' => now()]);
        $this->assertEquals('2021-10-30', $result);
    }

    /** @test */
    public function testCanFormatDateUsingString()
    {
        $result = format(DateFormatter::class, '2021-10-30 15:00:00');
        $this->assertEquals('2021-10-30', $result);

        $result = format(DateFormatter::class, '2021-11-01 15:00');
        $this->assertEquals('2021-11-01', $result);

        $result = format(DateFormatter::class, '2021-10-31');
        $this->assertEquals('2021-10-31', $result);
    }

    /** @test */
    public function testCanFormatDateUsingArray()
    {
        $result = format(DateFormatter::class, ['to_format' => '2021-10-30 15:00:00']);
        $this->assertEquals('2021-10-30', $result);

        $result = format(DateFormatter::class, ['to_format' => '2021-11-01 15:00']);
        $this->assertEquals('2021-11-01', $result);

        $result = format(DateFormatter::class, ['to_format' => '2021-10-31']);
        $this->assertEquals('2021-10-31', $result);
    }
}