<?php
function arr_findMaxKey($myArr)
{
    $max = reset($myArr); //выдаёт значение первого элемента в асс. массиве
    $maxKey = array_search($max, $myArr); //выдаёт ключ по значению, если не нашёл - false

    foreach ($myArr as $key => $value) {
        if ($value > $max) {
            $max = $value;
            $maxKey = $key;
        }
    }
    return $maxKey;
}

function arr_sumOfKeyIsNum($myArr)
{
    $res = 0;
    foreach ($myArr as $key => $value) {
        if (is_numeric($key)) {
            $res += $value;
        }
    }
    return $res;
}

$myArr = ["min" => 5, 4 => 6, "this is maximum" => 666, 1 => 10,];
print_r($myArr);
echo "</br>MaxKey: " . arr_findMaxKey($myArr);
echo "</br>Sum of values which keys are numeric: " . arr_sumOfKeyIsNum($myArr);

?>

</br></br></br></br>
<style> a { font-family: arial; }</style>
<a href="https://first.loc/hw/hw_calc.php">Калькулятор ___________ (hw/hw_calc.php)</a></br>
<a href="https://first.loc/hw/hw_arr.php">Массивы ______________ (hw/hw_arr.php)</a></br>
<a href="https://first.loc/hw/hw_fact.php">Факториал _____________ (hw/hw_fact.php)</a></br>
<a href="https://first.loc/hw/hw_nums.php">(2)=>(10) _______________ (hw/hw_nums.php)</a></br>
<a href="https://first.loc/hw/hw_add.php">Дополнительно _________ (hw/hw_add.php)</a></br>
