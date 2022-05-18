<?php

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Collection\LocaleNumberFormatter;

class LocaleNumberFormatterTest extends TestCase
{
    /** @test */
    public function testCanFormatUsingFirstParameter()
    {
        $result = format('locale-number', 10000);

        $this->assertSame('10,000.00', $result);
    }

    /** @test */
    public function testCanFormatUsingStringBinding()
    {
        $result = format('locale-number', ['number' => 10000.50, 'locale' => 'pl']);

        $this->assertSame('10 000,50', $result);
    }

    /** @test */
    public function testCanFormatWithVariadicParameters()
    {
        $result = format('locale-number', 10000.50, 'pl');

        $this->assertSame('10 000,50', $result);
    }

    /** @test */
    public function testFormatBehaviorWithNullOrEmpty()
    {
        $format = format('locale-number');
        $this->assertSame('0.00', $format);

        $format = format('locale-number', '');
        $this->assertSame('0.00', $format);

        $format = format('locale-number', null);
        $this->assertSame('0.00', $format);
    }

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
        $result = $this->trimSpecialCharacters(
            format(LocaleNumberFormatter::class, [
                'number' => 10000,
                'locale' => 'fr',
            ])
        );

        $this->assertSame('10 000,00', $result);

        $result = $this->trimSpecialCharacters(
            format(LocaleNumberFormatter::class, [
                'number' => 10000.00,
                'locale' => 'fr',
            ])
        );

        $this->assertSame('10 000,00', $result);

        $result = $this->trimSpecialCharacters(
            format(LocaleNumberFormatter::class, [
                'number' => 10000.50,
                'locale' => 'fr',
            ])
        );

        $this->assertSame('10 000,50', $result);

        $result = $this->trimSpecialCharacters(
            format(LocaleNumberFormatter::class, [
                'number' => 10000.5549,
                'locale' => 'fr',
            ])
        );

        $this->assertSame('10 000,55', $result);

        $result = $this->trimSpecialCharacters(
            format(LocaleNumberFormatter::class, [
                'number' => 10000.5550,
                'locale' => 'fr',
            ])
        );

        $this->assertSame('10 000,56', $result);
    }
}
