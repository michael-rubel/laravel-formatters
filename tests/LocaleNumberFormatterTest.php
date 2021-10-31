<?php

namespace MichaelRubel\Formatters\Tests;

use Carbon\Carbon;
use MichaelRubel\Formatters\Collection\DateTimeFormatter;
use MichaelRubel\Formatters\Collection\LocaleNumberFormatter;

class LocaleNumberFormatterTest extends TestCase
{
    /** @test */
    public function testCanFormatNumberBasedOnPlLocale()
    {
        $result = str_replace(
            "\xc2\xa0",
            ' ',
            format(LocaleNumberFormatter::class, [
                'to_format' => 10000,
                'locale' => 'pl',
            ])
        );

        $this->assertSame('10 000', $result);

        $result = str_replace(
            "\xc2\xa0",
            ' ',
            format(LocaleNumberFormatter::class, [
                'to_format' => 10000.00,
                'locale' => 'pl',
            ])
        );

        $this->assertSame('10 000', $result);

        $result = str_replace(
            "\xc2\xa0",
            ' ',
            format(LocaleNumberFormatter::class, [
                'to_format' => 10000.50,
                'locale' => 'pl',
            ])
        );

        $this->assertSame('10 000,5', $result);
    }

    /** @test */
    public function testCanFormatNumberBasedOnEnLocale()
    {
        $result = str_replace(
            "\xc2\xa0",
            ' ',
            format(LocaleNumberFormatter::class, [
                'to_format' => 10000,
                'locale' => 'en',
            ])
        );

        $this->assertSame('10,000', $result);

        $result = str_replace(
            "\xc2\xa0",
            ' ',
            format(LocaleNumberFormatter::class, [
                'to_format' => 10000.00,
                'locale' => 'en',
            ])
        );

        $this->assertSame('10,000', $result);

        $result = str_replace(
            "\xc2\xa0",
            ' ',
            format(LocaleNumberFormatter::class, [
                'to_format' => 10000.50,
                'locale' => 'en',
            ])
        );

        $this->assertSame('10,000.5', $result);
    }
}
