<!-- function fNAME([PARAMS]) {
[RETURN ...]
С пустым return вернётся null 
}
 -->
<?php
br();
function br()
{
    echo "<br>";
}

function printTitle($str, $hName = 4, $color = "black")
{
    echo "<h$hName style='color:" . $color . "'>$str</h$hName>";
}

printTitle("Hello P21");
printTitle("Hello PHP", 1);
printTitle("WakeUp NEO", 4, 'red');

function calc_sum(...$nums)
{
    $sum = 0;
    foreach ($nums as $num) {
        $sum += $num;
    }
    $sum /= count($nums);
    return $sum;
}

br();
$arr = [12, 33, 55, 77, 34, 666];
$s = calc_sum(12, 33, 55, 77, 34, 666);
echo "$s";
br();
$s = calc_sum(...$arr);
echo "$s";


//область видимости
function testGlobals()
{
    //global $s; //забрать из глобальной области видимости
    //$s = 0; //создаёт локальную копию

    $GLOBALS["s"] = 0;
}
testGlobals();
br();
echo("$s");
$GLOBALS["test_var"] = 777;
br();
print_r($GLOBALS);
br();
echo $test_var;

function testStaticWord() {
    static $i = 0;
    echo ++$i;
}
br();
testStaticWord();
testStaticWord();
testStaticWord();
br();
$hello = function($name) {
    printTitle("TukTuk $name", 4, 'green');
};
$hello("Alice");

//callback - функция, передаваемая в качестве аргумента функции

function welcome(callable $message) {
    $message();
}

$goodMorning = function() {printTitle("Good Morning");};
$goodEvening = function() {printTitle("Good Evening");};

welcome($goodMorning);
welcome($goodEvening);

function filterArr($nums_arr, $condition) {
    $result = [];
    foreach ($nums_arr as $num) {
        if ($condition($num)) {
            $result[] = $num;
        }
    }
    return $result;
}

$isEvenNumber = function($num) {return $num % 2 === 0;};
$isPositiveNumber = function($num) {return $num > 0;};

$arr = [12, -33, 55, -77, -34, 0];
$arr = filterArr($arr, $isEvenNumber);
br();
print_r($arr);
$arr = filterArr($arr, $isPositiveNumber);
br();
print_r($arr);

$n = 50;
$show = function() use ($n) {
    echo $n;
};
br();
$show();
br();
//fn(params) => code;

$a = 5;
$b = 1;
$closure = fn($a, $b) => $a + $b;
echo $closure($a, $b);

//isset - проверка на существование в массиве


