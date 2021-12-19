<?php

namespace MichaelRubel\Formatters\Tests;

use Carbon\Carbon;
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
    }

    /** @test */
    public function testCanFormatDateTimeUsingCarbonInstance()
    {
        $result = format(DateTimeFormatter::class, now());
        $this->assertEquals('2021-10-30 14:00', $result);

        $result = format(DateTimeFormatter::class, ['to_format' => now()]);
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
        $result = format(DateTimeFormatter::class, ['to_format' => '2021-11-01 15:00:00']);
        $this->assertEquals('2021-11-01 15:00', $result);

        $result = format(DateTimeFormatter::class, ['to_format' => '2021-11-01 15:00']);
        $this->assertEquals('2021-11-01 15:00', $result);

        $result = format(DateTimeFormatter::class, ['to_format' => '2021-11-01']);
        $this->assertEquals('2021-11-01 00:00', $result);
    }

    /** @test */
    public function testCanFormatUsingStringBinding()
    {
        $result = format('date-time', now());
        $this->assertEquals('2021-10-30 14:00', $result);

        $result = format('date-time', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30 17:00', $result);
    }
}
