<h2>This is Home</h2>
<?php

// $pass = "12345";
// $pass2 = "Alice";
// $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
// echo $hashed_pass;
// echo "</br>";
// $isEqual = password_verify($pass2, $hashed_pass);
// if ($isEqual) {
//     echo "Verified";
// }
// else {
//     echo "Wrong password";
// }

// "/expression/flags"
$pattern_phone = "/^\+7 ?\(? ?\d{3} ?\)? ?\d{3}-?\d{2}-?\d{2}$/";
$pattern_dramatic = "/\.{3}/";
$pattern_error = "/\b0x\d{2}\b/";
$pattern_html = "/<\/?[a-z]\d?[a-z]*>/i";
$pattern_group = "/(go|stop){3}/i";

$string = "gogogo";
$isMatch = preg_match($pattern_group, $string);
echo "String: ".$string."</br>Pattern: ".$pattern_group;
if ($isMatch) {
    echo "<br> pattern YES <br>";
} else {
    echo "<br> pattern NO <br>";
}

//hrml
// <h1> </h1> <div>
//



// флаги
// i - игнорирует регистр
// g - ищет все совпадения, без него ищет только первое вхождение
// u - кодировка
// наборы и диапазоны
// [...]
// [aieo] // подойдет любой символ из набора
// [0-9] //
// [a-z] [A-Z] [а-яА-Я]
// /[0-9a-zA-Z]/ -> /[0-9a-z]/i
// [^0-9a-zA-Z] -> ^ логическое отрицание

// ^ -> начало строки
// $ -> строки
// / [ ] \ ^ $ . | ? * + ( ) { } <- символы, которые нужно писать через \
 
// квантификаторы
// {n} -> n раз подряд
// {i,k} -> от i до k раз подряд
// {i, } -> i и более раз
// короткие
//? -> 0 или 1 раз {0, 1}
//+ 1 и более {1, }
//* 0 или более {0, }

// символьные классы
// \d <=> [0-9] числа
// \D = [^0-9] не число
// \w = [0-9a-zA-Z_]
// \W = [^0-9a-zA-Z_]
// \s - пробельные символы и перенос строки
// \S - Не пробельные символы
// . - любой символ, кроме \n (c флагом s любой)
// /\d\d\d\d/ - любая последовательность из 4х чисел
// /[0-9][0-9][0-9][0-9]/

?>