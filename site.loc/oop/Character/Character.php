<?php
require_once(__DIR__."\Loggable.php");
require_once(__DIR__."\Interactable.php");

class Character {
    use Loggable;    
    
    private $name;
    private $age;
    private $description;
    private static int $characterCount = 0;
    public static function getCharacterCount() {
        return self::$characterCount;
    }

    function __construct($name, $age, $description) {
        $this->name = $name;
        $this->age = $age;
        $this->description = $description;
        $this->log("Создан персонаж: {$this->name}");
        self::$characterCount++;
    }

    function introduce() {
        echo "Меня зовут {$this->name}, мне {$this->age} лет. {$this->description} <br>";
    }
}