<?php

namespace MichaelRubel\Formatters\Tests;

use Carbon\Carbon;
use MichaelRubel\Formatters\Collection\DateFormatter;
use MichaelRubel\Formatters\Exceptions\ShouldImplementInterfaceException;
use MichaelRubel\Formatters\Tests\Boilerplate\WrongFormatter;

class DateFormatterTest extends TestCase
{
    /**
     * Set up the tests.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow('2021-10-30 14:00:00');
    }

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

    /** @test */
    public function testCanFormatUsingStringBinding()
    {
        $result = format('date', now());
        $this->assertEquals('2021-10-30', $result);

        $result = format('date', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30', $result);
    }

    /** @test */
    public function testCanFormatWithTimezone()
    {
        Carbon::setTestNow('2022-03-24 23:30');
        config(['app.timezone' => 'Europe/Warsaw']);

        $result = format('date', now(), 'UTC');
        $this->assertEquals('2022-03-24', $result);

        $result = format('date', now());
        $this->assertEquals('2022-03-25', $result);
    }
}
