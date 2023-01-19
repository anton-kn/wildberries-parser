<?php
declare(strict_types=1);

namespace Parser;

class Message{

    public function setMessage(string $value)
    {
        $GLOBALS[$this->key] = $value . "\n";
        return $this;
    }

    public function getMessage()
    {
        if( count($GLOBALS[$this->key]) == false ){
            return "Сообщений нет! \n";
        }
        else{
            return $GLOBALS[$this->key];
        }    
    }
}