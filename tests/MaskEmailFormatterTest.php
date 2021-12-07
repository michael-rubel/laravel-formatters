<?php

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Collection\MaskEmailFormatter;

class MaskEmailFormatterTest extends TestCase
{
    /** @test */
    public function testCanFormatAsMaskedEmail()
    {
        $format = format(MaskEmailFormatter::class, 'test@example.com');

        $this->assertSame('test********.com', $format);

        $format = format(MaskEmailFormatter::class, 'masked@example.org');

        $this->assertSame('mask**********.org', $format);
    }
}
