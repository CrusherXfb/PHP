<?php

class Item implements Interactable {
    private $itemName;
    private $itemDescription;

    function __construct($itemName, $itemDescription) {
        $this->itemName = $itemName;
        $this->itemDescription = $itemDescription;
    }

    function interact(): void {
        echo "Вы взаимодействуете с предметом: {$this->itemName}. {$this->itemDescription}" . PHP_EOL;
    }
}



