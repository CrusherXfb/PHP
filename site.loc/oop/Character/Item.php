<?php
require_once(__DIR__."\Loggable.php");
require_once(__DIR__."\Interactable.php");

class Item implements Interactable
{
    use Loggable;
    private $itemName;
    private $itemDescription;

    function __construct($itemName, $itemDescription)
    {
        $this->itemName = $itemName;
        $this->itemDescription = $itemDescription;
        $this->log("Создан предмет: {$this->itemName}");
    }

    function interact()
    {
        $this->log(message: "Игрок взаимодействует с предметом: {$this->itemName}");
        echo "Вы взаимодействуете с предметом: {$this->itemName}. {$this->itemDescription} <br>";
    }

    function getName() {
        return $this->itemName;
    }
}



