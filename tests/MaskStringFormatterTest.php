<?php

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Collection\MaskStringFormatter;

class MaskStringFormatterTest extends TestCase
{
    /** @test */
    public function testCanFormatStringAsMasked()
    {
        $format = format(MaskStringFormatter::class, 'MyMaskedString');
        $this->assertSame('MyMa******ring', $format);

        $format = format(MaskStringFormatter::class, 'test@example.com');
        $this->assertSame('test********.com', $format);

        $format = format(MaskStringFormatter::class, 'testTestT');
        $this->assertSame('test*estT', $format);

        $format = format(MaskStringFormatter::class, 'tes');
        $this->assertSame('tes', $format);
    }

    /** @test */
    public function testCanFormatStringAsMaskedUsingArray()
    {
        $format = format(MaskStringFormatter::class, ['string' => 'MyMaskedString']);
        $this->assertSame('MyMa******ring', $format);
    }

    /** @test */
    public function testCanFormatUsingStringBinding()
    {
        $format = format('mask-string', 'test@example.com');
        $this->assertSame('test********.com', $format);
    }

    /** @test */
    public function testFormatBehaviorWithNullOrEmpty()
    {
        $format = format('mask-string');
        $this->assertSame('', $format);

        $format = format('mask-string', '');
        $this->assertSame('', $format);

        $format = format('mask-string', null);
        $this->assertSame('', $format);
    }

    /** @test */
    public function testCanExtendFormatterBinding()
    {
        extend(MaskStringFormatter::class, function ($formatter) {
            $formatter->string    = 'test@example.com';
            $formatter->character = '%';
            $formatter->index     = 5;
            $formatter->length    = -5;
            $formatter->encoding  = 'KOI8-U';

            $this->assertStringContainsString('test@example.com', $formatter->string);
            $this->assertStringContainsString('%', $formatter->character);
            $this->assertStringContainsString(5, $formatter->index);
            $this->assertStringContainsString(-5, $formatter->length);
            $this->assertStringContainsString('KOI8-U', $formatter->encoding);

            return $formatter;
        });

        $format = format(MaskStringFormatter::class, 'binding has the priority');
        $this->assertSame('test@%%%%%%e.com', $format);

        $format = format('mask-string', 'binding has the priority');
        $this->assertSame('test@%%%%%%e.com', $format);
    }
}
