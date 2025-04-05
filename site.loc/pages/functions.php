<?php
function registerUser(string $name, string $email, string $pass, string $pass_confirm)
{
    $errors = [];
    $name = trim(htmlspecialchars($name));
    $email = trim(htmlspecialchars($email));
    $pass = trim(htmlspecialchars($pass));
    $pass_confirm = trim(htmlspecialchars($pass_confirm));


    //echo "$name</br>$email</br>$pass</br>$pass_confirm</br>";
    $errors = validate($name, $email, $pass, $pass_confirm);
    if (!empty($errors)) {
        return $errors;
    }
    //print_r($errors);

    $users = "pages/users.txt";
    $file = fopen($users, "a+");

    while (!feof($file)) {
        $line = fgets($file);
        $dividerName = strpos($line, ":");
        $readedName = substr($line, 0, $dividerName);
        $dividerEmail = strrpos($line, ":");
        $readedEmail = substr($line, $dividerEmail + 1);

        if (trim($readedName) == $name) {
            $errors[] = "Пользователь с таким именем уже зарегистрирован";
            break;
        }

        if (trim($readedEmail) == $email) {
            $errors[] = "Пользователь с такой электронной почтой уже зарегистрирован";
            break;
        }

    }

    if (empty($errors)) {
        $line = $name . ":" . password_hash($pass, PASSWORD_DEFAULT) . ":" . $email . "\n";
        fwrite($file, $line);
    }

    fclose($file);


    return $errors;
}

function loginUser(string $name, string $pass)
{
    $result = false;
    $name = trim(htmlspecialchars($name));
    $pass = trim(htmlspecialchars($pass));

    $users = "pages/users.txt";
    $file = fopen($users, "a+");

    while (!feof($file)) {
        $line = fgets($file);
        if ($line == "") continue;
        list($readedName, $readedPass) = explode(":", trim($line), 3);        
        //explode вернёт массив строк, в котором будут части $line, разделённые двоеточием
        //limit 3, потому что в строке три части разделённые двоеточием, если поставить 2 то в пароль будет записываться email
        //с помощью list забираем значения элементов в readedName и readedPass
        if (trim($readedName) === $name && password_verify($pass, $readedPass)) {
            $result = true;
            break;
        }
    }


    fclose($file);

    return $result;
}

function validate(string $name, string $email, string $pass, string $pass_confirm)
{
    $errors = [];
    function len(string $str)
    {
        return mb_strlen($str, "UTF-8");
    }

    if (empty($name) || empty($email) || empty($pass) || empty($pass_confirm)) {
        $errors[] = "Все поля должны быть заполнены";
    }

    if ($pass !== $pass_confirm) {
        $errors[] = "Пароли не совпадают";
    }

    if (len($name) < 3 || len($name) > 15) {
        $errors[] = "Длина логина должна быть от 3 до 15 символов";
    }

    if (len($pass) < 3 || len($pass) > 30) {
        $errors[] = "Длина пароля должна быть от 3 до 30 символов";
    }

    return $errors;
}



function uploadFile($filename)
{
    echo $_FILES[$filename]['error'];
    if ($_FILES[$filename]['error'] != 0) {
        echo "<h4 style='color:red'>Ошибка при загрузке файла: " . $_FILES[$filename]['error'] . "</h4>";
        exit();
    }
    if (is_uploaded_file($_FILES[$filename]['tmp_name'])) {
        if (move_uploaded_file($_FILES[$filename]['tmp_name'], 'images/' . $_FILES[$filename]['name'])) {
            echo "<h4 style='color:green'>Файл успешно загружен!</h4>";
        } else {
            echo "<h4 style='color:red'>Не удалось сохранить файл!</h4>";
        }
    } else {
        echo "<h4 style='color:red'>Не удалось сохранить файл!</h4>";
    }
}

?>