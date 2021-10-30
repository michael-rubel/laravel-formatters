<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Exceptions;

class ShouldImplementInterfaceException extends \Exception
{
    protected $message = 'The formatter should implement MichaelRubel\Formatters\Formatter interface.';
}
