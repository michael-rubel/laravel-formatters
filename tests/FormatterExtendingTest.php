<?php

namespace MichaelRubel\Formatters\Tests;

use Carbon\Carbon;
use MichaelRubel\Formatters\Collection\DateFormatter;
use MichaelRubel\Formatters\Collection\DateTimeFormatter;
use MichaelRubel\Formatters\Exceptions\ShouldImplementInterfaceException;
use MichaelRubel\Formatters\Tests\Boilerplate\WrongFormatter;

class FormatterExtendingTest extends TestCase
{
    /** @test */
    public function testCanExtendFormatter()
    {
        $result = format(DateTimeFormatter::class, '2021-10-31');
        $this->assertEquals('2021-10-31 00:00', $result);

        app()->extend(DateTimeFormatter::class, function ($service) {
            $service->datetime_format = 'Y-m-d H:i:s';

            return $service;
        });

        $result = format(DateTimeFormatter::class, '2021-10-31');
        $this->assertEquals('2021-10-31 00:00:00', $result);
    }
}
