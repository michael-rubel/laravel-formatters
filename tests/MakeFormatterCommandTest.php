<?php

namespace MichaelRubel\Formatters\Tests;

class MakeFormatterCommandTest extends TestCase
{
    /** @test */
    public function testCanMakeFormatter()
    {
        $this->artisan('make:formatter', ['name' => 'TestFormatter']);

        $this->assertFileExists(
            app_path('Formatters' . DIRECTORY_SEPARATOR . 'TestFormatter.php')
        );
    }
}
