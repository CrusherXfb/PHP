<!--  -->
<?php

$arr = array(1, 3, 5);
$arr = [12, 33, 55, 77, 34, 7 => 666];
$arr[2] = 0;
$arr[] = 777;

print_r($arr);
//echo "$arr[5]";

foreach ($arr as $key => $val) {
   echo "$key => [$val] <br>";
}

$words = [
    "yellow" => "жёлтый", 
    "red" => "красный", 
    "black" => "чёрный", 
    "white" => "белый", 
    "green" => "зелёный",
];

$words["city"] = "город";
//$words[] = 7;

print_r($words);


 echo "<br>";
 ksort($words);
 print_r($words);

 echo "<br>";
 asort($words);
 print_r($words);

//count($words); - длина массива

// $i = 0;
// while (++$i) {
//     switch ($i) {
//         case 5:
//             echo "<br>Итерация 5<br>";
//             break 1;  /* Выйти только из конструкции switch. */
//         case 10:
//             echo "Итерация 10; выходим<br /><br>";
//             break 2;  /* Выходим из конструкции switch и из цикла while. */
//         default:
//             break;
//     }
// }


// //сортировка
// //по ключу
// //ksort() up
// //krsort() down
// echo "<br>";
// ksort($dic);
// print_r($dic);
 
// //по значению
// //asort up
// //arsort down
// asort($dic);
// print_r($dic);
 
// //shuffle перемешает и разорвет связь
// shuffle($dic);
// print_r($dic);
 
// // по ключу
// //sort up разорвет связь
// //rsort down разорвет связь
// // asort($dic);
// // print_r($dic);
 
// // sort($dic);
// // print_r($dic);
echo "<br>";

$technologies = [
    "frontend" => ['HTML/CSS', 'JavaScript', 'SaaS'],
    "backend" => ["PHP", "C#"],
    "dataBases" => ["SQL", "MySQL"],
];

foreach ($technologies as $tech => $tech_arr) {
    echo "<ul>";
    echo "<h4>$tech</h4>";
    foreach ($tech_arr as $t_name) {
        echo "<li>$t_name</li>";   
    }
    echo "</ul>";
}

print_r($GLOBALS);


