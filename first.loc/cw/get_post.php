<?php

//GET - передаёт запрос в адресной строке 
//POST - передаёт данные в теле запроса
//В POST можно отправить больше данных

require("funcs.php"); //требует чтобы файл существовал, иначе fatal error
//require_once("funcs.php"); //

//include("funcs.php"); //выбросит warning
//include_once("funcs.php"); //

printTitle("GET POST", 2, "red");

if ((isset($_GET['name'], $_GET['city']))) {
    br();
    echo "Name: {$_GET['name']}";
    br();
    echo "City: {$_GET['city']}";
} else {
    br();
    echo "Данные не получены";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="handler.php" method="GET">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name="sbmt" value="sbmt">Submit</button>
        </form>

        <form action="handler.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">[POST]Name</label>
                <input class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">[POST]Password</label>
                <input type="password" class="form-control" id="pass" name="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary" name="sbmt" value="sbmt">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>