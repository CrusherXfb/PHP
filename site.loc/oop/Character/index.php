<?php
require_once(__DIR__."\Character.php");
require_once(__DIR__."\Item.php");


$hero_paladin = new Character("Артур", 30, "Паладин");
$hero_magician = new Character("Генри", 57, "Маг-хилер.");

$legendary_sword = new Item("Легендарный меч", "Легендарный невероятно тяжёлый меч, сделанный из валирийской стали.");
$training_shield = new Item("Тренировочный щит", "Деревянный щит, который вряд ли сможет защитить от настоящего оружия.");

$hero_paladin->introduce();
$hero_magician->introduce();

$legendary_sword->interact();
$training_shield->interact();

echo "Characters count: ".Character::getCharacterCount();