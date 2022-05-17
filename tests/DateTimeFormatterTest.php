<?php

namespace MichaelRubel\Formatters\Tests;

use Carbon\Carbon;
use MichaelRubel\Formatters\Collection\DateFormatter;
use MichaelRubel\Formatters\Collection\DateTimeFormatter;

class DateTimeFormatterTest extends TestCase
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

        config(['app.timezone' => 'UTC']);
    }

    /** @test */
    public function testCanFormatDateTimeUsingCarbonInstance()
    {
        $result = format(DateTimeFormatter::class, now());
        $this->assertEquals('2021-10-30 14:00', $result);

        $result = format(DateTimeFormatter::class, ['datetime' => now()]);
        $this->assertEquals('2021-10-30 14:00', $result);
    }

    /** @test */
    public function testCanFormatDateTimeUsingString()
    {
        $result = format(DateTimeFormatter::class, '2021-10-31 17:00:00');
        $this->assertEquals('2021-10-31 17:00', $result);

        $result = format(DateTimeFormatter::class, '2021-10-31 17:00');
        $this->assertEquals('2021-10-31 17:00', $result);

        $result = format(DateTimeFormatter::class, '2021-10-31');
        $this->assertEquals('2021-10-31 00:00', $result);
    }

    /** @test */
    public function testCanFormatDateTimeUsingArray()
    {
        $result = format(DateTimeFormatter::class, ['datetime' => '2021-11-01 15:00:00']);
        $this->assertEquals('2021-11-01 15:00', $result);

        $result = format(DateTimeFormatter::class, ['datetime' => '2021-11-01 15:00']);
        $this->assertEquals('2021-11-01 15:00', $result);

        $result = format(DateTimeFormatter::class, ['datetime' => '2021-11-01']);
        $this->assertEquals('2021-11-01 00:00', $result);
    }

    /** @test */
    public function testFormatHelperFailsWhenMultipleArraysPassed()
    {
        $this->expectException(\TypeError::class);

        format(DateFormatter::class, ['datetime' => '2021-10-30 15:00:00'], ['test' => true]);
    }

    /** @test */
    public function testCanFormatUsingStringBinding()
    {
        $result = format('date-time', now());
        $this->assertEquals('2021-10-30 14:00', $result);

        $result = format('date-time', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30 17:00', $result);
    }

    /** @test */
    public function testCanFormatWithTimezone()
    {
        Carbon::setTestNow('2022-03-24 10:30');
        config(['app.timezone' => 'Europe/Warsaw']);

        $result = format('date-time', ['datetime' => now(), 'timezone' => 'UTC']);
        $this->assertEquals('2022-03-24 10:30', $result);

        $result = format('date-time', now());
        $this->assertEquals('2022-03-24 11:30', $result);
    }

    /** @test */
    public function testCanUseUnpackingParameters()
    {
        Carbon::setTestNow('2022-03-24 10:30');
        config(['app.timezone' => 'Europe/Warsaw']);

        $result = format('date-time', now(), 'UTC');
        $this->assertEquals('2022-03-24 10:30', $result);
    }

    /** @test */
    public function testCanExtendDateTimeFormatter()
    {
        config(['app.timezone' => 'UTC']);

        $result = format(DateTimeFormatter::class, '2021-10-31');
        $this->assertEquals('2021-10-31 00:00', $result);

        app()->extend(DateTimeFormatter::class, function ($service) {
            $service->timezone = 'Europe/Warsaw';
            $service->datetime_format = 'Y-m-d H:i:s';

            return $service;
        });

        $result = format(DateTimeFormatter::class, '2021-10-31');
        $this->assertEquals('2021-10-31 02:00:00', $result);
    }
}
