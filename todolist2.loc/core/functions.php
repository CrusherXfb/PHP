<?php

function dump($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function dd($data)
{
    dump($data);
    die();
}

function abort($code = 404)
{
    http_response_code($code);
    require ERRORS . "/{$code}.tmpl.php";
}

function loadPostData(array $fillable)
{
    $data = [];
    foreach ($_POST as $key => $value) {
        if (in_array($key, $fillable)) {
            $data[$key] = h($value);
        }
    }
    return $data;
}

//подставляет прошлое значение в форму
function old($fieldname)
{
    return isset($_POST[$fieldname]) ? h($_POST[$fieldname]) : '';
}

function h($str)
{
    if (!empty($str)){
        return trim(htmlspecialchars($str, ENT_QUOTES));
    } else {
        return $str;
    }
}

function stl($str)
{
    return mb_strlen($str, 'UTF-8');
}

function getAlerts()
{
    if (isset($_SESSION['success'])) {
        require_once(COMPONENTS . '/alert-success.php');
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        require_once(COMPONENTS . '/alert-error.php');
        unset($_SESSION['error']);
    }
}

function redirect($url = '')
{
    if ($url) {
        $redirect = $url;
    } else {
        //HTTP_REFERER  Адрес страницы, с которой браузер пользователя перешёл на текущую страницу.
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: {$redirect}");
    die;
}

?>