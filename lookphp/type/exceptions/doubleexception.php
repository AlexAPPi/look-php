<?php

namespace LookPhp\Type\Exceptions;

/**
 *  Класс исключения, связанного с неправильной передачей параметра
 */
class DoubleException extends NumericException
{
    const argumentErrMessage = 'not double';
}