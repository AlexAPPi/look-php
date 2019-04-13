<?php

namespace LookPhp\API\Parser\TypeScript;

use LookPhp\API\Parser\DocBlock;
use LookPhp\API\Parser\TypeScript\TSMethod;
use LookPhp\API\Parser\TypeScript\TSProperty;
use LookPhp\API\Parser\TypeScript\TSExporter;

class TSClass extends TSExporter
{
    /** @var bool */
    public $isAbstract;
    
    /** @var string */
    public $name;
    
    /** @var TSProperty[] */
    protected $propertys = [];
    
    /** @var TSMethod[] */
    protected $methods   = [];
    
    /** @var TSMethod */
    protected $constructor;
    
    /**
     * Формирует новый интерфейс
     * @param bool     $isAbstract -> Абстрактный класс
     * @param string   $name       -> Название
     * @param DocBlock $desc       -> Описание
     */
    public function __construct(bool $isAbstract, string $name, ?DocBlock $desc)
    {
        $this->isAbstract = $isAbstract;
        $this->desc       = $desc;
        $this->name       = $name;
        $this->propertys  = [];
        $this->methods    = [];
    }
    
    /**
     * @param TSMethod $method -> Метод
     */
    public function addMethod(TSMethod $method) : void
    {
        $this->methods[] = $method;
    }
    
    /**
     * Добавляет новое свойство
     * 
     * @param TSProperty $property -> Свойство
     */
    public function addProperty(TSProperty $property) : void
    {
        $this->propertys[] = $property;
    }
    
    /**
     * Устанавливает конструктор
     * @param TSMethod $method
     */
    public function setConstructor(TSMethod $method) : void
    {
        $this->constructor = $method;
    }
    
    /** {@inheritdoc} */
    protected function buildTS(int $offset, int $tabSize, string $mainTabStr, string $tabStr) : string
    {
        $fixName = $this->name;
        $desc    = $this->buildDesc($mainTabStr);
        
        $props       = null;
        $constructor = null;
        $methods     = null;
        
        // Не выводим свойства,
        // которые передаются через конструктор
        $removeProps = [];
        
        if($this->constructor) {
            if($this->constructor->arguments) {
                foreach($this->constructor->arguments as $argument) {
                    $removeProps[$argument] = true;
                }
            }
            $constructor = $this->constructor->toTS($offset + 1, $tabSize);
        }
        
        $i = 0;
        $propertysCount = count($this->propertys);
        if($propertysCount > 0) {
            $props = '';
            foreach($this->propertys as $prop) {
                $i++;
                $props .= $prop->toTS($offset + 1, $tabSize);
                if($i < $propertysCount) {
                    $props .= "\n";
                }
            }
        }
        
        $i = 0;
        $methodsCount = count($this->methods);
        if($methodsCount > 0) {
            $methods = '';
            foreach($this->methods as $method) {
                $i++;
                $methods .= $method->toTS($offset + 1, $tabSize);
                if($i < $methodsCount) {
                    $methods .= "\n";
                }
            }
        }
        
        $abstract = $this->isAbstract ? "abstract " : "";
        
        return
        $desc .
        $mainTabStr . "export {$abstract}class $fixName\n" .
        $mainTabStr . "{\n" .
        $props .
        $constructor .
        $methods .
        $mainTabStr . "}\n";
    }
}