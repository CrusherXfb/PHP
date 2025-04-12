<?php
require_once(__DIR__."\Character.php");
require_once(__DIR__."\Item.php");
require_once(__DIR__."\NPC_trader.php");
require_once(__DIR__."\NPC_quest.php");
require_once(__DIR__."\Location.php");

$forest_camp = new Location("Лагерь в лесу");

$hero_paladin = new Character("Артур", 30, "Паладин.");
$hero_magician = new Character("Генри", 57, "Маг-хилер.");

$NPC_trader_forest = new NPC_trader("Лесник", 44, "Торговец снаряжением.");
$NPC_quest_forest = new NPC_quest("Волк", 37, "Лидер лагеря в лесу.");

$legendary_sword = new Item( "Легендарный меч", "Легендарный невероятно тяжёлый меч, сделанный из валирийской стали.");
$training_shield = new Item("Тренировочный щит", "Деревянный щит, который вряд ли сможет защитить от настоящего оружия.");
$training_sword = new Item( "Тренировочный меч", "Деревянный меч, отлично подойдёт для тренировок между путешествиями.");

$forest_camp->addCharacter($hero_paladin);
$forest_camp->addCharacter($NPC_quest_forest);
$forest_camp->addCharacter($NPC_trader_forest);

$hero_paladin->introduce();
$hero_magician->introduce();
$NPC_trader_forest->introduce();

$NPC_trader_forest->addItem($training_shield, 2, 5);
$NPC_trader_forest->addItem($training_sword,3,5);

$legendary_sword->interact();
$training_shield->interact();
$training_sword->interact();

$questName = "Пропавший меч";
$questDescription = "У меня пропал меч. Это непростой меч, о нём ходят легенды! Найди его для меня, наградой не обижу.";
$questObjective = "Принести Волку легендарный меч";
$questReward = new Reward(null, 5, 200);
$newQuest = new Quest($questName, $questDescription, $questObjective, $questReward);
$NPC_quest_forest->addQuest($newQuest);

$forest_camp->interact();

$NPC_trader_forest->interact();
$NPC_quest_forest->interact();

echo "Characters count: ".Character::getCharacterCount();