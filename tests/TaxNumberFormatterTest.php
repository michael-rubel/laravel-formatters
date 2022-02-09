<?php

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Collection\TaxNumberFormatter;

class TaxNumberFormatterTest extends TestCase
{
    /** @test */
    public function testCanFormatTaxNumber()
    {
        $result = format(TaxNumberFormatter::class, [
            'country_iso' => 'PL',
            'tax_number'  => '0123456789',
        ]);

        $this->assertEquals('PL0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithLowerCountryCharacter()
    {
        $result = format(TaxNumberFormatter::class, [
            'country_iso' => 'pl',
            'tax_number'  => '0123456789',
        ]);

        $this->assertEquals('PL0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithEmptyCountry()
    {
        $result = format(TaxNumberFormatter::class, [
            'country_iso' => '',
            'tax_number'  => '0123456789',
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
            'country_iso' => 'PL',
            'tax_number'  => 'FR0123456789',
        ]);

        $this->assertEquals('PLFR0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithCharactersErasedNumber()
    {
        $result = format(TaxNumberFormatter::class, [
            'country_iso' => 'pL',
            'tax_number'  => '+01 23-45.67,89',
        ]);

        $this->assertEquals('PL0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithSameCountryPrefixAs()
    {
        $result = format(TaxNumberFormatter::class, [
            'country_iso' => 'pL',
            'tax_number'  => 'PL0123456789',
        ]);

        $this->assertEquals('PL0123456789', $result);
    }


    /** @test */
    public function testCanFormatTaxNumberIfAlwaysPrefixIsUppercase()
    {
        $result = format(TaxNumberFormatter::class, [
            'country_iso' => 'pl',
            'tax_number'  => 'pL0123456789',
        ]);

        $this->assertEquals('PL0123456789', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithEmptyData()
    {
        $result = format(TaxNumberFormatter::class, [
            'country_iso' => '',
            'tax_number'  => '',
        ]);

        $this->assertEquals('', $result);
    }

    /** @test */
    public function testCanFormatTaxNumberWithOnlyCounty()
    {
        $result = format(TaxNumberFormatter::class, [
            'country_iso' => 'pL',
        ]);

        $this->assertEquals('PL', $result);
    }
}
