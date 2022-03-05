<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use MichaelRubel\Formatters\Formatter;
use MichaelRubel\Formatters\Traits\HelpsFormatData;

class MaskStringFormatter implements Formatter
{
    use HelpsFormatData;

    /**
     * @var string
     */
    public string $character = '*';

    /**
     * @var int
     */
    public int $index = 4;

    /**
     * @var int
     */
    public int $length = -4;

    /**
     * @var string
     */
    public string $encoding = 'UTF-8';

    /**
     * Format string as masked.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        return Str::mask(
            $this->extractStringFromCollection($items),
            $this->character,
            $this->index,
            $this->length,
            $this->encoding
        );
    }
}
