<?php

namespace MichaelRubel\Formatters\Tests;

class FormatterBindingsTest extends TestCase
{
    /** @test */
    public function testStringBindingsWorksProperly()
    {
        $result = format('date', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30', $result);

        $result = format('date_time', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30 17:00', $result);

        $result = format('table_column', 'created_at');
        $this->assertEquals('Created at', $result);
    }
}
