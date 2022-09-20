<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

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
        $filteredTaxNumber = preg_replace_array('/[^\d\w]/', [], (string) $this->tax_number);

        $this->tax_number = str($filteredTaxNumber)
            ->upper()
            ->value();

        $this->country = str($this->country)
            ->upper()
            ->value();
    }

    /**
     * Format the Tax Number.
     *
     * @return string
     */
    public function format(): string
    {
        return ! blank($this->country)
            ? $this->getFullTaxNumber()
            : (string) $this->tax_number;
    }

    /**
     * @return string
     */
    private function getPrefix(): string
    {
        return str($this->tax_number)
            ->substr(0, 2)
            ->upper()
            ->value();
    }

    /**
     * @return string
     */
    private function getFullTaxNumber(): string
    {
        return str($this->getPrefix())->startsWith($this->country)
            ? str($this->tax_number)->substr(2)->start($this->country)->value()
            : str($this->tax_number)->start($this->country)->value();
    }
}
