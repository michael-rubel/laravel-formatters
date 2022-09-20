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
        $name = format(FullNameFormatter::class, ' MichaelRubél ');

        $this->assertSame('Michael Rubél', $name);
    }

    public function testAddsSpaceBetweenWordsOrHandlesPascalCase()
    {
        $name = format(FullNameFormatter::class, 'MichaelRubél');

        $this->assertSame('Michael Rubél', $name);
    }

    public function testHandlesSnakeCase()
    {
        $name = format(FullNameFormatter::class, 'michael_rubél');

        $this->assertSame('Michael Rubél', $name);
    }

    public function testHandlesCamelCase()
    {
        $name = format(FullNameFormatter::class, 'michaelRubél');

        $this->assertSame('Michael Rubél', $name);
    }

    public function testHandlesKebabCase()
    {
        $name = format(FullNameFormatter::class, 'michael-rubél');

        $this->assertSame('Michael Rubél', $name);
    }

    public function testEmptyStringAndWeirdSymbols()
    {
        $name = format(FullNameFormatter::class, '');
        $this->assertSame('', $name);

        $name = format(FullNameFormatter::class, '   ');
        $this->assertSame('', $name);

        $name = format(FullNameFormatter::class, '  ...  ');
        $this->assertSame('...', $name);

        $name = format(FullNameFormatter::class, '⠀');
        $this->assertSame('⠀', $name);

        $name = format(FullNameFormatter::class, ' ');
        $this->assertSame('', $name);
    }
}
