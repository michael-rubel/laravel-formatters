<?php

namespace MichaelRubel\Formatters\Tests;

use Carbon\Carbon;
use MichaelRubel\Formatters\Collection\DateTimeFormatter;
use MichaelRubel\Formatters\Collection\LocaleNumberFormatter;
use NumberFormatter;

class LocaleNumberFormatterTest extends TestCase
{
    /** @test */
    public function testCanFormatNumberBasedOnPlLocale()
    {
        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000,
            'locale' => 'pl',
        ]);

        $this->assertSame('10 000,00', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.00,
            'locale' => 'pl',
        ]);

        $this->assertSame('10 000,00', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.50,
            'locale' => 'pl',
        ]);

        $this->assertSame('10 000,50', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.5549,
            'locale' => 'pl',
        ]);

        $this->assertSame('10 000,55', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.5550,
            'locale' => 'pl',
        ]);

        $this->assertSame('10 000,56', $result);
    }

    /** @test */
    public function testCanFormatNumberBasedOnEnLocale()
    {
        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000,
            'locale' => 'en',
        ]);

        $this->assertSame('10,000.00', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.00,
            'locale' => 'en',
        ]);

        $this->assertSame('10,000.00', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.50,
            'locale' => 'en',
        ]);

        $this->assertSame('10,000.50', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.5549,
            'locale' => 'en',
        ]);

        $this->assertSame('10,000.55', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.5550,
            'locale' => 'en',
        ]);

        $this->assertSame('10,000.56', $result);
    }

    /** @test */
    public function testCanFormatNumberBasedOnFrLocale()
    {
        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000,
            'locale' => 'fr',
        ]);

        $this->assertSame('10 000,00', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.00,
            'locale' => 'fr',
        ]);

        $this->assertSame('10 000,00', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.50,
            'locale' => 'fr',
        ]);

        $this->assertSame('10 000,50', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.5549,
            'locale' => 'fr',
        ]);

        $this->assertSame('10 000,55', $result);

        $result = format(LocaleNumberFormatter::class, [
            'number' => 10000.5550,
            'locale' => 'fr',
        ]);

        $this->assertSame('10 000,56', $result);
    }
}
