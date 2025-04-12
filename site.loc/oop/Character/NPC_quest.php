<?php 

class NPC_quest extends Character implements Interactable {
    private array $quests; //массив квестов (пока не придумал как реализовать множество квестов)
    public function interact() {
        $this->log("Игрок взаимодействует с персонажем {$this->name}");
        if (!empty($this->quests)) {
            echo "У меня есть задание: <br>";
            $this->quests[0]->showQuestFull(); //вызывается только первый квест
        }
        else { //если квестов нет (подразумевается что при выполнении квеста он удаляется из массива)
            echo "Привет, герой! К сожалению, больше работы для тебя нет. Но тебя вегда рады видеть здесь! <br>";
        }
    }

    public function addQuest (Quest $quest) { //добавление квеста в массив
        $this->quests[] = $quest;
        $this->log("Добавлен квест {$quest->getName()} персонажу {$this->name}");
    }
        
}

class Quest { //для удобства добавления нескольких квестов, решил в одном файле делать чтобы всё связанное с квестами было рядом
    private string $name;
    private string $description;
    private string $objective;
    private Reward $reward; 

    public function __construct(string $name, string $description, string $objective, Reward $reward)
    {
        $this->name = $name;
        $this->description = $description;
        $this->objective = $objective;
        $this->reward = $reward;
    }

    public function showQuest () { //отображение квеста для interact у НПС
        echo '"'.$this->name.'"'."<br>";
        echo "Описание: ".$this->description."<br>";
        echo "Цель: ".$this->objective."<br>";
    }

    public function showQuestFull () { //отображение квеста вместе с наградой для interact у НПС
        echo '"'.$this->name.'"'."<br>";
        echo "Описание: ".$this->description."<br>";
        echo "Цель: ".$this->objective."<br>";
        echo "Награда: <br>";
        $this->reward->showReward();
        echo "<br>";
    }

    public function getName() {
        return $this->name;
    }
}

class Reward {
    private ?Item $item; //подразумевается что не всегда в награду за квест будет выдаваться предмет, пока что может выдаваться только один предмет
    private int $money;
    private int $experience;

    public function __construct(?Item $item, int $money, int $experience) {
        $this->item = $item;
        $this->money = $money;
        $this->experience = $experience;
    }

    public function showReward() { //отображение награды для завершения квеста или для полного отображения квеста в showQuestFull()
        if ($this->item != null) {
                echo "Предмет: {$this->item->interact()}<br>";
        }
        if ($this->money != null) {
            echo "Деньги: {$this->money} coins<br>";
        }
        if ($this->experience != null) {
            echo "Опыт: {$this->experience} exp<br>";
        }
    }
}