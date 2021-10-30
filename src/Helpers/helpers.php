<?php

declare(strict_types=1);

use MichaelRubel\Formatters\Exceptions\ShouldImplementInterfaceException;
use MichaelRubel\Formatters\Formatter;
use MichaelRubel\Formatters\FormatterServiceProvider;

if (! function_exists('format')) {
    /**
     * @param string       $formatter
     * @param string|array $items
     *
     * @return mixed
     * @throws ShouldImplementInterfaceException
     */
    function format(string $formatter, string|array $items): mixed
    {
        $formatter = class_exists($formatter) || interface_exists($formatter)
            ? app($formatter)
            : app($formatter . FormatterServiceProvider::FORMATTER_POSTFIX);

        if (! $formatter instanceof Formatter) {
            throw new ShouldImplementInterfaceException();
        }

        /** @phpstan-ignore-next-line */
        return $formatter->format(
            collect($items)
        );
    }
}