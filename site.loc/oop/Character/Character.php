<?php

class Character {
    private $name;
    private $age;
    private $description;

    function __construct($name, $age, $description) {
        $this->name = $name;
        $this->age = $age;
        $this->description = $description;
    }

    function introduce() {
        echo "Меня зовут $this->name, мне $this->age лет. $this->description <br>";
    }
}