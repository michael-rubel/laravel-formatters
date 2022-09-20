<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use MichaelRubel\Formatters\Formatter;

class MaskStringFormatter implements Formatter
{
    /**
     * @param  string|null  $string
     * @param  string  $character
     * @param  int  $index
     * @param  int  $length
     * @param  string  $encoding
     */
    public function __construct(
        public ?string $string = '',
        public string $character = '*',
        public int $index = 4,
        public int $length = -4,
        public string $encoding = 'UTF-8',
    ) {
    }

    /**
     * Mask the string.
     *
     * @return string
     */
    public function format(): string
    {
        return str($this->string)
            ->mask($this->character, $this->index, $this->length, $this->encoding)
            ->value();
    }
}
