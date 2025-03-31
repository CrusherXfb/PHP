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
    if (!empty($errors)) { return $errors; }
    //print_r($errors);

    $users = "pages/users.txt";
    $file = fopen($users, "a+");

    while(!feof($file)) {
        $line = fgets($file);
        $divider = strpos($line,":");
        $readedName = substr($line,0, $divider);

        if($readedName == $name) {
            $errors[] = "Пользователь с таким именем уже зарегистрирован";
            break;
        }
    }

    if (empty($errors)) {
        $line = $name.":".password_hash($pass, PASSWORD_DEFAULT).";".$email."\n";
        fwrite($file, $line);
    }

    fclose($file);


    return $errors;
}

function validate(string $name, string $email, string $pass, string $pass_confirm) 
{
    $errors = [];
    function len(string $str) { return mb_strlen($str, "UTF-8"); }

    if(empty($name) || empty($email) || empty($pass) || empty($pass_confirm)) {
        $errors[] = "Все поля должны быть заполнены";
    }

    if ($pass !== $pass_confirm){
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



?>