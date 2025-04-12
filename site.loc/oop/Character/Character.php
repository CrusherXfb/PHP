<?php
require_once(__DIR__."\Loggable.php"); //для трейта

class Character {
    use Loggable;    
    
    protected $name;
    protected $age;
    protected $description;
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

    function getName() {
        return $this->name;
    }
}