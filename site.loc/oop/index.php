<?php

const MYCONST1 = 1;
define("MYCONST2", 1);

class Person
{
    public readonly string $name;
    protected int $age;
    private static int $id = 0;
    const TYPE = "MILK";
    private $secret = "secret info";

    function __construct($name, $age)
    {
        self::$id++;
        $this->name = $name;
        $this->age = $age;
    }

    function sayHi()
    {
        echo "Hello $this->name!<br>";
    }

    function __destruct()
    {
        echo "Object $this->name deleted<br>";
    }

    function displayInfo()
    {
        echo "ID: " . self::$id . "<br>";
        echo "Name: $this->name<br>";
        echo "Age: $this->age<br>";

    }

    static function getLastId()
    {
        echo "ID: " . self::$id . "<br>";
    }
}

class Employee extends Person
{
    function __construct($name, $age, public string $company)
    {
        parent::__construct($name, $age);
        $this->company = $company;
    }

    function displayInfo()
    {
        parent::displayInfo();
        echo "Company: $this->company<br>";
    }
}


$p1 = new Person("Alice", 0);
$p1->displayInfo();
$p2 = new Person("Bogdan", 0);
$emp1 = new Employee("Anastasia", 14, "TOP");
$emp1->displayInfo();
//var_dump($p);
echo "<br>";
$p1->sayHi();
$p2->sayHi();
$emp1->sayHi();

Person::getLastId();
echo Person::TYPE;
echo "<br>";



//трейты
trait Printer
{
    public function printP($text)
    {
        echo "<p>$text</p>";
    }
    public function printH($text, $hNum)
    {
        echo "<h$hNum>$text</h$hNum>";
    }

}

class Message {
    use Printer;
}

$msg = new Message();
$msg->printP("My trait printP!<br>");
$msg->printH("My trait printH!<br>", 2);

?>

<a href="logs.php">logs.php</a><br>


















