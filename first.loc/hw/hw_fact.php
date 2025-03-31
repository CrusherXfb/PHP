<?php

function findFactorial ($num) 
{
    if ($num <= 1)  //если дошли до единицы, заканчиваем цепочку
        return 1; 
    else    //если всё ещё не единица, то умножаем результат и спускаемся на следующщую ступень вниз
        return $num * findFactorial($num - 1);    
}

$num = 7;
echo "$num! = ".findFactorial($num);

?>

</br></br></br></br>
<style> a { font-family: arial; }</style>
<a href="https://first.loc/hw/hw_calc.php">Калькулятор ___________ (hw/hw_calc.php)</a></br>
<a href="https://first.loc/hw/hw_arr.php">Массивы ______________ (hw/hw_arr.php)</a></br>
<a href="https://first.loc/hw/hw_fact.php">Факториал _____________ (hw/hw_fact.php)</a></br>
<a href="https://first.loc/hw/hw_nums.php">(2)=>(10) _______________ (hw/hw_nums.php)</a></br>
<a href="https://first.loc/hw/hw_add.php">Дополнительно _________ (hw/hw_add.php)</a></br>
