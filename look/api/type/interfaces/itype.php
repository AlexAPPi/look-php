<?php

namespace Look\API\Type\Interfaces;

/**
 * Список скалярных типов
 */
interface IType
{
    /** Неопределенный тип */
    const TNULL = 'NULL';

    /** Тип объекта */
    const TObject = 'object';

    /** Тип функции */
    const TCallable = 'callable';

    /** Логичесткое */
    const TBool = 'boolean';
    
    /** Тип integer */
    const TInteger = 'integer';
    
    /** Тип double */
    const TDouble = 'double';
    
    /** Тип float */
    const TFloat = self::TDouble;
    
    /** Тип integer|double */
    const TNumeric = self::TInteger . '|' . self::TDouble;
    
    /** Тип unsigned integer */
    const TUnsignedInteger = 'unsigned ' . self::TInteger;
    
    /** Тип unsigned double */
    const TUnsignedDouble = 'unsigned ' . self::TDouble;
    
    /** Тип unsigned integer|double */
    const TUnsignedNumeric = 'unsigned ' . self::TNumeric;

    /** Тип string */
    const TString = 'string';

    /** Тип array */
    const TArray = 'array';

    /** Пустой массив */
    const TEmptyArray = 'empty ' . self::TArray;

    /** Массив из разных типов */
    const TMultiArray = self::TArray;
    
    /** Массив bool (только из true|false) */
    const TBoolArray = self::TBool . ' ' . self::TArray;
    
    /** Массив из чисел */
    const TNumericArray = self::TNumeric . ' ' . self::TArray;
    
    /** Массив только из целых чисел */
    const TIntegerArray = self::TInteger . ' ' . self::TArray;
    
    /** Массив только из дробных чисел */
    const TDoubleArray = self::TDouble . ' ' . self::TArray;
    
    /** Массив только из положительных чисел */
    const TUnsignedNumericArray = self::TUnsignedNumeric . ' ' . self::TArray;
    
    /** Массив только из целых положительных чисел */
    const TUnsignedIntegerArray = self::TUnsignedInteger . ' ' . self::TArray;
    
    /** Массив только из дробных положительных чисел */
    const TUnsignedDoubleArray = self::TUnsignedDouble . ' ' . self::TArray;
    
    /** Не определенный тип данных */
    const TMixed = 'mixed';
    
    /** Скалярный тип */
    const TScalar = self::TNumeric . '|' . self::TBool . '|' . self::TString;
    
    /** Enum тип */
    const TEnum = 'enum';
    
    /** Iterable тип */
    const TIterable = 'iterable';
    
    /**
     * Наследник системного типа PHP
     * 
     * @return bool
     */
    static function __extendsSystemType() : bool;
    
    /**
     * Возвращает название системного скалярного типа
     *
     * @return string
     */
    static function __getSystemEvalType() : string;
}