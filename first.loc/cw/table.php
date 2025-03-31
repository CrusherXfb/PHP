<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table > <!-- Добавил border для лучшей видимости таблицы -->
        <?php
            for ($i = 2; $i <= 9; $i++) 
            {
                echo "<tr>"; // Закрываем тег <tr> здесь
                for ($j = 2; $j <= 9; $j++) 
                {
                    echo "<td>". ($i * $j) ."</td>";
                }
                echo "</tr>"; // Закрываем тег </tr> после завершения внутреннего цикла
            }
        ?>
    </table>
</body>
</html>
