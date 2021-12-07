<?php

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Collection\MaskStringFormatter;

class MaskEmailFormatterTest extends TestCase
{
    /** @test */
    public function testCanFormatAsMaskedEmail()
    {
        $format = format(MaskStringFormatter::class, 'MyMaskedString');

        $this->assertSame('MyMa******ring', $format);

        $format = format(MaskStringFormatter::class, 'test@example.com');

        $this->assertSame('test********.com', $format);
    }
}
