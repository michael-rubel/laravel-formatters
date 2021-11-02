<?php

declare(strict_types=1);

use MichaelRubel\Formatters\FormatterServiceProvider;

if (! function_exists('format')) {
    /**
     * @param string $formatter
     * @param mixed  $items
     *
     * @return mixed
     */
    function format(string $formatter, mixed $items): mixed
    {
        $formatter = class_exists($formatter) || interface_exists($formatter)
            ? app($formatter)
            : app($formatter . FormatterServiceProvider::BINDING_POSTFIX);

        FormatterServiceProvider::ensureFormatterImplementsInterface($formatter);

        /** @phpstan-ignore-next-line */
        return $formatter->format(
            collect($items)
        );
    }
}
