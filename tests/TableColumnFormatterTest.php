<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Collection\TableColumnFormatter;

class TableColumnFormatterTest extends TestCase
{
    /** @test */
    public function testCanFormatTableColumn()
    {
        $columnAttributes = collect([
            'id',
            'name',
            'description',
            'tax_document',
            'created_at',
            'updated_at',
        ]);

        $formattedColumns = $columnAttributes->map(
            fn ($column) => format(TableColumnFormatter::class, $column)
        );

        $this->assertEquals('Id', $formattedColumns[0]);
        $this->assertEquals('Name', $formattedColumns[1]);
        $this->assertEquals('Description', $formattedColumns[2]);
        $this->assertEquals('Tax document', $formattedColumns[3]);
        $this->assertEquals('Created at', $formattedColumns[4]);
        $this->assertEquals('Updated at', $formattedColumns[5]);
    }

    /** @test */
    public function testCanFormatUsingStringBinding()
    {
        $format = format('table-column', 'created_at');
        $this->assertSame('Created at', $format);

        $format = format('table-column', ['attribute' => 'created_at']);
        $this->assertSame('Created at', $format);
    }

    /** @test */
    public function testFormatBehaviorWithNullOrEmpty()
    {
        $format = format('table-column');
        $this->assertSame('', $format);

        $format = format('table-column', '');
        $this->assertSame('', $format);

        $format = format('table-column', null);
        $this->assertSame('', $format);
    }

    /** @test */
    public function testCanExtendFormatterBinding()
    {
        $this->app->extend(TableColumnFormatter::class, function ($formatter) {
            $formatter->string = 'created_at';

            $this->assertStringContainsString('created_at', $formatter->string);

            return $formatter;
        });

        $format = format(TableColumnFormatter::class, 'created_at');
        $this->assertSame('Created at', $format);

        $format = format('table-column', 'created_at');
        $this->assertSame('Created at', $format);
    }
}
