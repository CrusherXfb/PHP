<?php
function check_binary_num($binary_num) { //проверка на отсутствие лишних знаков в числе для подтверждения его двоичности
    $symbols_count = strlen((string) $binary_num);
    for ($i = 0; $i < $symbols_count; $i++) {
        if ($binary_num % 10 == 0 || $binary_num % 10 == 1) continue;
        else return false;
    }
    return true;
}

function binary_to_decimal($binary_num)
{
    if (!check_binary_num($binary_num))
        return "Not a binary num";
    if ($binary_num == 0) return 0;
    $decimal_num = 0;
    $symbols_count = strlen((string) $binary_num); //парсим в string и получаем количество знаков в числе
    $k = 0; //степень двойки
    for ($i = 0; $i < $symbols_count; $i++) {
        $decimal_num += ($binary_num % 10) * (2 ** $k);
        $binary_num -= $binary_num % 10;
        $binary_num /= 10;
        $k++; //повышаем разряд
    }
    return $decimal_num;
}

$binary_num = 1000000;
echo "$binary_num (2) = ".(binary_to_decimal($binary_num))." (10)";

?>

</br></br></br></br>
<style> a { font-family: arial; }</style>
<a href="https://first.loc/hw/hw_calc.php">Калькулятор ___________ (hw/hw_calc.php)</a></br>
<a href="https://first.loc/hw/hw_arr.php">Массивы ______________ (hw/hw_arr.php)</a></br>
<a href="https://first.loc/hw/hw_fact.php">Факториал _____________ (hw/hw_fact.php)</a></br>
<a href="https://first.loc/hw/hw_nums.php">(2)=>(10) _______________ (hw/hw_nums.php)</a></br>
<a href="https://first.loc/hw/hw_add.php">Дополнительно _________ (hw/hw_add.php)</a></br>
