<?php

$myInt = 42;
$myFloat = 3.14;
$myString = "Hello, Alice!";

echo "Int: $myInt</br>Float: $myFloat</br>String: $myString</br></br>";

echo "Type of $myInt is ".(gettype($myInt))."</br>";
echo 'Is type of $myString string? '.(is_string($myString) ? "Yes!" : "No!")."</br>";
echo 'Does $myFloat still exist? '.(isset($myFloat) ? "Yes!" : "No!");
echo "</br>";
echo 'Unsetting $myFloat then...'."</br>"; unset($myFloat);
echo 'Does $myFloat still exist? '.(isset($myFloat) ? "Yes!" : "No!");
echo "</br>";

?>

</br></br></br></br>
<style> a { font-family: arial; }</style>
<a href="https://first.loc/hw/hw_calc.php">Калькулятор ___________ (hw/hw_calc.php)</a></br>
<a href="https://first.loc/hw/hw_arr.php">Массивы ______________ (hw/hw_arr.php)</a></br>
<a href="https://first.loc/hw/hw_fact.php">Факториал _____________ (hw/hw_fact.php)</a></br>
<a href="https://first.loc/hw/hw_nums.php">(2)=>(10) _______________ (hw/hw_nums.php)</a></br>
<a href="https://first.loc/hw/hw_add.php">Дополнительно _________ (hw/hw_add.php)</a></br>
