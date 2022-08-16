<?php

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Collection\TaxNumberFormatter;

class TaxNumberFormatterTest extends TestCase
{
    /** @test */
    public function testCanFormatTaxNumber()
    {
        $result = format(TaxNumberFormatter::class, [
            'tax_number' => '0123456789',
            'country'    => 'UA',
        ]);

        $this->assertEquals('UA0123456789', $result);
    }

    /** @test */
    public function testCanUseVariadicParameters()
    {
        $result = format(TaxNumberFormatter::class, 'UA0123456789', 'UA');
        $this->assertEquals('UA0123456789', $result);

        $result = format(TaxNumberFormatter::class, 'UA0123456789');
        $this->assertEquals('UA0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithLowerCountryCharacter()
    {
        $result = format(TaxNumberFormatter::class, [
            'tax_number' => '0123456789',
            'country'    => 'pl',
        ]);

        $this->assertEquals('PL0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithEmptyCountry()
    {
        $result = format(TaxNumberFormatter::class, [
            'tax_number' => '0123456789',
            'country'    => '',
        ]);

        $this->assertEquals('0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithoutCountry()
    {
        $result = format(TaxNumberFormatter::class, [
            'tax_number' => '0123456789',
        ]);

        $this->assertEquals('0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithDiffCountryPrefix()
    {
        $result = format(TaxNumberFormatter::class, [
            'tax_number' => 'FR0123456789',
            'country'    => 'PL',
        ]);

        $this->assertEquals('PLFR0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithCharactersErasedNumber()
    {
        $result = format(TaxNumberFormatter::class, [
            'tax_number' => '+01 23-45.67,89',
            'country'    => 'pL',
        ]);

        $this->assertEquals('PL0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithSameCountryPrefixAs()
    {
        $result = format(TaxNumberFormatter::class, [
            'tax_number' => 'PL0123456789',
            'country'    => 'pL',
        ]);

        $this->assertEquals('PL0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberIfAlwaysPrefixIsUppercase()
    {
        $result = format(TaxNumberFormatter::class, [
            'tax_number' => 'pL0123456789',
            'country'    => 'pl',
        ]);

        $this->assertEquals('PL0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithEmptyData()
    {
        $result = format(TaxNumberFormatter::class, [
            'tax_number' => '',
            'country'    => '',
        ]);

        $this->assertEquals('', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithOnlyCounty()
    {
        $result = format(TaxNumberFormatter::class, [
            'country' => 'pL',
        ]);

        $this->assertEquals('PL', $result);
    }

    /** @test */
    public function testCanFormatUsingStringBinding()
    {
        $result = format('tax-number', [
            'tax_number' => '0123456789',
            'country'    => 'UA',
        ]);

        $this->assertEquals('UA0123456789', $result);
    }

    /** @test */
    public function testCanFormatPassingVariadicParameters()
    {
        $result = format(TaxNumberFormatter::class, '0123456789', 'UA');

        $this->assertEquals('UA0123456789', $result);
    }

    /** @test */
    public function testFormatBehaviorWithNullOrEmpty()
    {
        $format = format('tax-number');
        $this->assertSame('', $format);

        $format = format('tax-number', '');
        $this->assertSame('', $format);

        $format = format('tax-number', null);
        $this->assertSame('', $format);
    }

    /** @test */
    public function testCanExtendTaxNumberFormatter()
    {
        extend(TaxNumberFormatter::class, function ($formatter) {
            $formatter->tax_number = 'UA0123456789';
            $formatter->country    = 'UA';

            return $formatter;
        });

        $result = format(TaxNumberFormatter::class, [
            'tax_number' => 'extend has priority',
            'country'    => 'extend has priority',
        ]);

        $this->assertEquals('UA0123456789', $result);
    }

    /** @test */
    public function testSanitizesTaxNumbersWithDashes()
    {
        $result = format(TaxNumberFormatter::class, '526-10-40-567', 'PL');
        $this->assertSame('PL5261040567', $result);

        $result = format(TaxNumberFormatter::class, ' 526- -10 -40- 567 ', 'PL');
        $this->assertSame('PL5261040567', $result);
    }
}
