<?php

declare(strict_types=1);

use MichaelRubel\EnhancedContainer\Call;
use MichaelRubel\Formatters\FormatterService;
use MichaelRubel\Formatters\FormatterServiceProvider;

if (! function_exists('format')) {
    /**
     * @param string $formatter
     * @param mixed  $items
     *
     * @return mixed
     */
    function format(string $formatter, mixed ...$items): mixed
    {
        $items = FormatterService::unwrapIfArray($items);

        $formatter = class_exists($formatter) || interface_exists($formatter)
            ? call($formatter, $items)
            : call($formatter . FormatterServiceProvider::BINDING_POSTFIX, $items);

        FormatterService::ensureFormatterImplementsInterface(
            $formatter->getInternal(Call::INSTANCE)
        );

        return $formatter->format();
    }
}
