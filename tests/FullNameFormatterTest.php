<?php

declare(strict_types=1);

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
        $name = format(FullNameFormatter::class, 'michael rubél');
        $this->assertSame('Michael Rubél', $name);
        $name = format(FullNameFormatter::class, 'michael mcKenzie');
        $this->assertSame('Michael McKenzie', $name);
    }

    public function testCanFormatNameWithMinusSeparators()
    {
        $name = format(FullNameFormatter::class, 'Anna Nowak-Kowalska');
        $this->assertSame('Anna Nowak-Kowalska', $name);
        $name = format(FullNameFormatter::class, ' anna nowak-kowalska ');
        $this->assertSame('Anna Nowak-kowalska', $name);
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

    public function testSanitizesInvisibleChars()
    {
        $name = format(FullNameFormatter::class, 'Test Full 
Name');
        $this->assertSame('Test Full Name', $name);
    }
}
