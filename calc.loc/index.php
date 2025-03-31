<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор</title>
</head>

<body>
    <style> 
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        input[type="number"],
        select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #218838;
        }

        h4 {
            text-align: center;
            color: #333;
        }
    </style> 
    <!-- Автор стилей - нейронка -->

    <h1>Калькулятор</h1>

    <form>
        <input type="number" name="num1" placeholder="Введите первое число" required>
        <input type="number" name="num2" placeholder="Введите второе число" required>
        <select name="operation" required>
            <option value="">Выберите операцию</option>
            <option value="plus">+ (сложение)</option>
            <option value="minus">- (вычитание)</option>
            <option value="multiply">* (умножение)</option>
            <option value="divide">/ (деление)</option>
            <option value="pow">** (степень)</option>
        </select>
        <button>Выполнить</button>
    </form>

    <?php
    $num1 = $_GET['num1'] ?? null; //проверка на существование и получение первого числа
                                    //$_GET - суперглобальный (звучит страшно) массив, содержащий параметры, переданные через URL,
                                    //из которого мы по ключу 'num1' пытаемся получить значение в $num1
                                    //оператор ?? проверяет 'num1' на существование в массиве $_GET
                                    //и в случае false задаёт $num1 значение null
                                    //называется "оператор нулевого слияния"
                                    //на всякий случай написал комментарий, чтобы показать, 
                                    //что я не просто взял из интернета, а разобрался
    $num2 = $_GET['num2'] ?? null; //проверка на существование и получение второго числа
    $operation = $_GET['operation'] ?? null;  //проверка на существование и получение оператора
    
    if ($num1 !== null && $num2 !== null && $operation) {
        switch ($operation) {
            case 'plus':
                $result = $num1 + $num2;
                break;
            case "minus":
                $result = $num1 - $num2;
                break;
            case "multiply":
                $result = $num1 * $num2;
                break;
            case "divide":
                if ($num2 != 0)
                    $result = $num1 / $num2;
                else
                    $result = "деление на 0";
                break;
            case "pow":
                $result = $num1 ** $num2;
                break;
        }
        echo "<h4>Результат: $result</h4>";
    }
    ?>
</body>

</html>