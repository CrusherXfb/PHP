<?php

class NPC_trader extends Character implements Interactable
{
    private array $traderItems = []; //массив предметов у торговца
    public function interact()
    {
        $this->log(message: "Игрок взаимодействует с торговцем: {$this->name}");
        if (!empty($this->traderItems)) {
            echo "Взгляни на мои товары: <br>";
            foreach ($this->traderItems as $item) {
                echo $item->showItem();
            }
        } else {
            echo "Товаров пока нет :(";
        }
    }
    public function addItem(Item $item, $count, $cost) //добавление предмета торговцу
    {
        foreach ($this->traderItems as $traderItem) { //если предмет уже есть в ассортименте торговца, то количество увеличивается, а цена обновляется
            if ($traderItem->getName() === $item->getName()) {
                $traderItem->setCount($traderItem->getCount() + $count);
                $traderItem->setCost($cost);
                $this->log("Добавлено $count предмета {$item->getName()} торговцу {$this->name}");
                break;
            }
        }
        $newItem = new TraderItem($item->getName(), $count, $cost);
        $this->traderItems[] = $newItem;
        $this->log(message: "Добавлен предмет {$item->getName()} торговцу {$this->name}");

    }
}

class TraderItem extends Item
{
    private $name;
    private $count;
    private $cost;
    public function __construct(string $name, int $cost, int $count)
    {
        $this->name = $name;
        $this->count = $count;
        $this->cost = $cost;
    }
    public function showItem() //отображение товаров в ассортименте по interact
    {
        echo $this->name . " x" . $this->count . ", " . $this->cost . " coins <br>";
    }

    public function getCount()
    {
        return $this->count;
    }
    public function setCount(int $count)
    {
        $this->count = $count;
    }
    public function getCost() {
        return $this->cost;
    }
    public function setCost(int $cost) {
        $this->cost = $cost;
    }
}
