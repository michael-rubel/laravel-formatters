<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use MichaelRubel\Formatters\Formatter;

class FullNameFormatter implements Formatter
{
    /**
     * @param  string|null  $name
     */
    public function __construct(public ?string $name)
    {
        //
    }

    /**
     * Format the full name.
     *
     * @return string
     */
    public function format(): string
    {
        $words = str($this->name)->split('/\s/');

        $this->name = $words->map(function (string $word) {
            return str($word)->ucfirst();
        })->join(' ');

        return str($this->name)
            ->replaceMatches('/\p{C}+/u', '')
            ->squish()
            ->value();
    }
}
