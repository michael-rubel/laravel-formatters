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
    public function testCanFormatUsingStringBinding()
    {
        $format = format('mask-string', 'test@example.com');

        $this->assertSame('test********.com', $format);
    }
}
