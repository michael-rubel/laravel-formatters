<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Str;
use MichaelRubel\Formatters\Formatter;

class TaxNumberFormatter implements Formatter
{
    /**
     * @param  string|null  $tax_number
     * @param  string|null  $country
     */
    public function __construct(
        public ?string $tax_number = null,
        public ?string $country = null
    ) {
        $filteredTaxNumber = preg_replace('/[^\d\w]/', '', (string) $this->tax_number);

        $this->tax_number = Str::upper($filteredTaxNumber);
        $this->country    = Str::upper($this->country);
    }

    /**
     * Format the Tax Number.
     *
     * @return string|null
     */
    public function format(): ?string
    {
        return ! blank($this->country)
            ? $this->getFullTaxNumber()
            : $this->tax_number;
    }

    /**
     * @return string
     */
    private function getFullTaxNumber(): string
    {
        $string = str($this->tax_number);

        $value = $string->startsWith($this->country)
            ? $string->substr(2)->start($this->country)
            : $string->start($this->country);

        return $value->toString();
    }
}
