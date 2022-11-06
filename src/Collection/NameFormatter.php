<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use MichaelRubel\Formatters\Formatter;

class NameFormatter implements Formatter
{
    /**
     * @param  string|null  $name
     */
    public function __construct(public ?string $name)
    {
        //
    }

    /**
     * Format the generic name.
     *
     * @return string
     */
    public function format(): string
    {
        return str($this->name)
            ->replaceMatches('/\p{C}+/u', '')
            ->replace(['\r', '\n', '\t'], '')
            ->squish()
            ->value();
    }
}
