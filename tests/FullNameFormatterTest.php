<?php

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Collection\FullNameFormatter;

class FullNameFormatterTest extends TestCase
{
    public function testCanUseStringBinding()
    {
        $name = format('full-name', 'michael');

        $this->assertSame('Michael', $name);
    }

    public function testCanFormatFirstName()
    {
        $name = format(FullNameFormatter::class, 'michael');

        $this->assertSame('Michael', $name);
    }

    public function testCanFormatLastName()
    {
        $name = format(FullNameFormatter::class, 'rubél');

        $this->assertSame('Rubél', $name);
    }

    public function testCanFormatFirstAndLastName()
    {
        $name = format(FullNameFormatter::class, 'michaeL rubéL');

        $this->assertSame('Michael Rubél', $name);
    }

    public function testCutsSpaceBeforeAndAfter()
    {
        $name = format(FullNameFormatter::class, ' Michael Rubél ');

        $this->assertSame('Michael Rubél', $name);
    }

    public function testEmptyString()
    {
        $name = format(FullNameFormatter::class, '');
        $this->assertSame('', $name);

        $name = format(FullNameFormatter::class, '   ');
        $this->assertSame('', $name);
    }
}
