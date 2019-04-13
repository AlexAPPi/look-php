<?php

namespace LookPhp\API\Parser\TypeScript;

use LookPhp\Type\TypedArray;
use LookPhp\Type\Converter;
use LookPhp\API\Parser\DocBlock;
use LookPhp\API\Parser\TypeScript\TSArgument;
use LookPhp\API\Parser\DocBlock\ParamDocBlock;

/**
 * Список аргументов
 */
class TSArgumentList extends TypedArray
{
    /** @var string Базовый тип массива */
    const EvalType = Converter::TArray;
    
    /** @var string Назание класса по умолчанию */
    const DefaultItemType = Converter::TMixed;

    /** @var string Тип подставки данных */
    const ItemType = TSArgument::class;
    
    protected $desc;

    /**
     * Базовый класс типизироанного массива данных
     * 
     * @param DocBlock|null $desc  -> Блок описания
     * @param TSArgument    $items -> Передаваемые значения
     */
    public function __construct(?DocBlock $desc, TSArgument ...$items)
    {
        $this->desc = $desc;
        
        if($items) {
            parent::__construct(...$items);
        }
    }
    
    /**
     * Формирует документацию для аргументов
     * @param string $mainTabStr -> Отступ от начала строки
     * @param string $tabStr     -> Отступ от начала реализации объекта
     * @return string|null
     */
    public function buildDesc(string $mainTabStr, string $tabStr = '') : ?string
    {
        if($this->desc
        && $this->m_array
        && count($this->m_array) > 0) {

            $sortList = [];
            foreach($this->m_array as $arg) {
                $sortList[$arg->position] = $arg->name;
            }
            ksort($sortList);

            $paramDesc = $this->desc->param;
            
            if($paramDesc) {
                $result = "";
                foreach($sortList as $argName) {
                    $extractDoc = $paramDesc[$argName];
                    if($extractDoc instanceof ParamDocBlock) {
                        // * {NAME} {DESC}
                        $result .= $mainTabStr . $tabStr . " * @param $extractDoc->name $extractDoc->desc\n";
                    }
                }
                return $result;
            }
        }
        
        return null;
    }
    
    /**
     * Преобразует объект в TypeScript
     * @return string|null
     */
    public function toTS() : ?string
    {
        if($this->m_array && count($this->m_array) > 0) {
            
            $sortList = [];
            foreach($this->m_array as $arg) {
                $sortList[$arg->position] = $arg;
            }
            ksort($sortList);
            $result = "";
            foreach($sortList as $argument) {
                $result .= ', ' . $argument->toTS(0, 0);
            }
            
            return substr($result, 2);
        }
        
        return null;
    }
}