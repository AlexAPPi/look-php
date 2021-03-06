<?php

namespace Look\API\Exceptions;

use Throwable;

interface IAPIExceptionHandler extends Throwable
{
    public function render($request, Throwable $exception);
}
