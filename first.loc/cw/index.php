<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>Hello html</h4>

</body>
</html>
 -->

<?php
$a = 5 <=> 5; //0
$b = 7 <=> 5; //1
$c = 7 <=> 15; //-1

echo "<br><br> a = $a <br> b = $b <br> c = $c <br>";

$test = 15;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- //вариант 1 -->
    <?php if ($test > 0){ ?>
        <p>переменная больше 0</p>
    <?php } else if ($test < 0){ ?>
        <p>переменная больше 0</p>
    <?php } ?>

    <?php $test = -12; ?>

    <!-- //варииант 2 -->
    <?php if ($test > 0): ?>
        <p>переменная больше 0</p>
    <?php elseif ($test < 0): ?>
        <p>переменная меньше 0</p>
    <?php endif; ?>
</body>
</html>
<?php
  
//switch - нестрогое сравнение
//match - строгое сравнение 

// $a = "5";
// $result = match ($a) {
//     1 => 'сложение',
//     2 => 'вычитание',
//     5 => 'умножение',
//     "5" => "?",
//     default => 'default',
// };
// echo "$result";

//Прекращение обоих циклов
// for () {
//     for () {
//         if () {
//             break 2;
//         }
//     }
// }

//isset($var1, $var2) //- вернёт true если все переменные объявлены 
//unset($var1, $var2)

//const MYCONST = 11;
//define() - предпочтительнее 


