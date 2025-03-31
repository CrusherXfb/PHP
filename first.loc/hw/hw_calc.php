<?php

$a = 5;
$b = 0;
$operator = "sss";
$res = 0;

match ($operator) {
    "+" => $res = $a + $b,
    "-" => $res = $a - $b,
    "*" => $res = $a * $b,
    "**" => $res = $a ** $b,
    "/" => $b !== 0 ?
    $res = $a / $b
    : $res = "Error: Division by zero",
    default => $res = "Error: Operator '$operator' not found",
};

echo $a." $operator ".$b." = ".$res;

?>

</br></br></br></br>
<style> a { font-family: arial; }</style>
<a href="https://first.loc/hw/hw_calc.php">Калькулятор ___________ (hw/hw_calc.php)</a></br>
<a href="https://first.loc/hw/hw_arr.php">Массивы ______________ (hw/hw_arr.php)</a></br>
<a href="https://first.loc/hw/hw_fact.php">Факториал _____________ (hw/hw_fact.php)</a></br>
<a href="https://first.loc/hw/hw_nums.php">(2)=>(10) _______________ (hw/hw_nums.php)</a></br>
<a href="https://first.loc/hw/hw_add.php">Дополнительно _________ (hw/hw_add.php)</a></br>
