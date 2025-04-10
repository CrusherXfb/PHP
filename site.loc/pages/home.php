<h2>This is Home</h2>
<?php

// $pattern_date1 = "/^(0[1-9]|[12][0-9]|3[01]).(0[1-9]|1[0-2]).d{4}$/"; //не работает
// $pattern_date2 = "/^(0[1-9]|[12][0-9]|3[01]).(0[1-9]|1[0-2]).dddd$/"; //не работает
// $pattern_date3 = "/^(0[1-9]|[12][0-9]|3[01]).(0[1-9]|1[0-2]).[0-9][0-9][0-9][0-9]$/"; //работает
// $pattern_date4 = "/^(0[1-9]|[12][0-9]|3[01]).(0[1-9]|1[0-2]).[0-9]{4}$/"; //сокращённый вариант



$patterns = []; //массив паттернов
$pattern_username = "/^[а-яА-Я]+(-[а-яА-Я]+)*$/u";
$pattern_hex = "/^#[0-9A-F]{6}$/";
$pattern_date4 = "/^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[0-2])\.[0-9]{4}$/"; //сокращённый вариант

$patterns['username'] = $pattern_username;
$patterns['hex'] = $pattern_hex;
$patterns['date'] = $pattern_date4;

$pattern;
$string;
foreach ($patterns as $key => $value) { 
    switch ($key) {
        case 'username':
            $string = "Ортега-и-Гассет"; //строка для проверки
            //Анна-Мария, Ван-дер-Ваальс, Ортега-и-Гассет 
            //Санта-, Мария--Антуанетта
            break;
        case "date":
            $string = "01.12.2012";
            break;
        case "hex":
            $string = "#AA00AA";
            break;
    }
    $pattern = $value; //подключение паттерна
    echo "Pattern $key:<br><div class='container'>";
    $isMatch = preg_match($pattern, $string);
    echo "String: " . $string . "</br>Pattern: " . $pattern;
    if ($isMatch) {
        echo ($key == "hex" ? "<br><h4 style='color:$string'>pattern YES </h4><br>" : "<br> pattern YES <br>");
        //если паттерн hex, то при прохождении регулярного выражения текст выведется получившимся цветом
    } else {
        echo "<br> pattern NO <br>";
    }
    echo "</div><br>";
}









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
// $pattern_phone = "/^\+7 ?\(? ?\d{3} ?\)? ?\d{3}-?\d{2}-?\d{2}$/";
// $pattern_dramatic = "/\.{3}/";
// $pattern_error = "/\b0x\d{2}\b/";
// $pattern_html = "/<\/?[a-z]\d?[a-z]*>/i";
// $pattern_group = "/(go|stop){3}/i";

// 



// $isMatch = preg_match($pattern_hex, $string);
// echo "String: ".$string."</br>Pattern: ".$pattern_hex;
// if ($isMatch) {
//     echo "<br> pattern YES <br>";
// } else {
//     echo "<br> pattern NO <br>";
// }

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