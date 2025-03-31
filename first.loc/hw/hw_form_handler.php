<?php

require("funcs.php");

if (isset($_POST["sbmt"])) {

    printTitle('Бланк заявки на кредит');

    $name = htmlspecialchars($_POST["name"]);
    $surn = htmlspecialchars($_POST["surname"]);
    $patr = htmlspecialchars($_POST["patronym"]);
    $age = htmlspecialchars($_POST["age"]);
    $work = htmlspecialchars($_POST["work"]);

    $gend = htmlspecialchars($_POST["gender"]);
    $sum = htmlspecialchars($_POST["sum"]);
    $term = htmlspecialchars($_POST["term"]);
    $inc = htmlspecialchars($_POST["inc"]);

    $start_rate = 30; //начальная ставка

    //вывод базовой информации
    echo "Имя: $name</br> 
          Фамилия: $surn</br>
          Отчество: $patr</br>
          Пол: " . ($gend == 'male' ? 'МУЖ' : 'ЖЕН') . "</br>
          Возраст: $age</br>
          Занятость: ";

    $work_add = 0; //увеличение ставки в зависимости от занятости
    switch ($work) {
        case "individual":
            echo "ИП";
            $work_add = 5;
            break;
        case "selfEmployed":
            echo "самозанятый";
            $work_add = 5;
            break;
        case "LLC":
            echo "ООО";
            break;
    }
    echo "</br>";

    $special_add = 0; //увеличение ставки из-за принадлежности к особой группе
    if (isset($_POST['is_parent_hero'])) {
        echo "* Многодетный родитель</br>";
        $special_add = 5;
    }
    if (isset($_POST['is_retiree'])) {
        echo "* Пенсионер</br>";
        $special_add = 7;
    }
    if (isset($_POST['is_svo_part'])) {
        echo "* Участник СВО</br>";
        $special_add = 7;
    }

    //вывод информации касающейся денег
    echo "Сумма кредита: $sum</br>
          Срок кредита: $term мес.</br>
          Доход клиента: $inc</br>";


    $rate = $start_rate + $work_add + $special_add; //годовая ставка
    $monthly_rate = ($rate * 0.01) / 12; //ежемесячная ставка
    //ежемесячный платёж
    $monthly_pay = round(($sum * ($monthly_rate * (1 + $monthly_rate) ** $term) / (((1 + $monthly_rate) ** $term) - 1)), 2);

    echo "Ставка: $rate%</br>
        Ежемесячный платёж: $monthly_pay</br>";
    echo "Решение по кредиту: ";
    $reason = false;
    if ($age < 21)
        $reason = "маленький ещё (<21)";
    if ($age > 55)
        $reason = "автоматический отказ лицам старше 55 лет";
    if ($monthly_pay > ($inc / 2))
        $reason = "ежемесячный платёж превышает 50% от дохода";
    if ($gend == 'female' && $age < 30 && isset($_POST['is_parent_hero']))
        $reason = 'автоматический отказ многодетным матерям в возрасте до 30 лет';
    //если есть причины отказать
    if ($reason) {
        printTitle("ОТКАЗАНО" . "</br>Причина: $reason");
    } else {
        printTitle("ОДОБРЕНО");
    }
}
?>