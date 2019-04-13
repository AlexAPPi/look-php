<?php

namespace LookPhp\Type\Exceptions;

/**
 *  Класс исключения, связанного с неправильной передачей параметра
 */
class NumericArrayException extends ArrayException
{
    const argumentErrMessage = 'not numeric array';
}