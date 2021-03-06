<?php

namespace Look\Type;

use Look\Type\Exceptions\MailException;

/**
 * Класс для работы с Email
 */
class Email
{
    /**
     * Регулярное выражение проверки Email
     */
    const regex = '/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i';
        
    /**
     * Email адрес
     * @var string
     */
    protected $address;

    /**
     * Проверяет, является ли данный объект Email
     * @param string $email
     * @return type
     */
    public static function isEmail(string $email)
    {
        return preg_match(static::regex, $email);
    }
    
    /**
     * Создает Email объект
     * 
     * @param string $email -> Email адрес
     * @throws MailException
     */
    public function __construct(string $email) {
        
        if (static::isEmail($email)) {
            $this->address = $email;
        } else {
            throw new MailException($email);
        }
    }
    
    /**
     * Возвращает email адрес
     * 
     * @return string
     */
    public function getAddress() : string
    {
        return $this->address;
    }
    
    /**
     * Преобразует объект в строку
     * @return string
     */
    public function __toString() : string
    {
        return $this->getAddress();
    }
}