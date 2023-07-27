<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Collection\NameFormatter;

class NameFormatterTest extends TestCase
{
    public function testSanitizesName()
    {
        $name = format(NameFormatter::class, '      Test Name     ');
        $this->assertSame('Test Name', $name);
    }

    public function testRemovesUnixCodes()
    {
        $name = format(NameFormatter::class, ' Test\r\n\t Name ');
        $this->assertSame('Test Name', $name);
    }

    public function testSanitizesInvisibleChars()
    {
        $name = format(NameFormatter::class, 'Test
Name');
        $this->assertSame('TestName', $name);
    }

    public function testCanUseStringBinding()
    {
        $name = format('name', 'Michael');

        $this->assertSame('Michael', $name);
    }

    public function testEmptyString()
    {
        $name = format(NameFormatter::class, '');
        $this->assertSame('', $name);

        $name = format(NameFormatter::class, '   ');
        $this->assertSame('', $name);
    }
}
