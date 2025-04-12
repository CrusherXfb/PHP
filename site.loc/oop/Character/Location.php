<?php

class Location
{
    use Loggable;
    private string $name;
    private array $characters = [];
    private array $items = [];

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->log("Создана локация: ". $this->name);
    }

    public function addCharacter(Character $character)
    {
        $this->characters[] = $character;
        $this->log(message: "На локацию ". $this->name. " добавлен персонаж {$character->getName()}");
    }

    public function addItem(Item $item)
    {
        $this->items[] = $item;
        $this->log(message: "На локацию ". $this->name. " добавлен предмет {$item->getName()}");

    }

    public function interact(): void
    {
        $this->log("Игрок отобразил информацию о локации ". $this->name);
        echo "Вы находитесь в локации: {$this->name}<br>";
        if (!empty($this->characters)) {
            echo "Персонажи в этой локации:<br>";
            foreach ($this->characters as $character) {
                echo "- " . $character->getName() . "<br>";
            }
        }
        if (!empty($this->items)) {
            echo "Предметы в этой локации:<br>";
            foreach ($this->items as $item) {
                echo "- " . $item->getName() . "<br>";
            }
        }
    }
}