<?php

namespace Look\Type\Exceptions;

/**
 *  Класс исключения, связанного с неправильной передачей параметра
 */
class BooleanException extends InvalidArgumentException
{
    const argumentErrMessage = 'not bool';
}