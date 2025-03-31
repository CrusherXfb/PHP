<?php
require("funcs.php");


if (isset($_GET['sbmt'])) {
    $name = htmlspecialchars(string: $_GET["name"]);
    $pass = htmlentities($_GET["password"]);
    br();
    printTitle("GET method");
    echo"Name: {$name}"; br();    
    echo"Pass: {$pass}";br();
}
else if (isset($_POST['sbmt'])) {
    $name = htmlspecialchars($_POST["name"]);
    $pass = htmlentities($_POST["password"]);
    br();
    printTitle("POST method");
    echo"Name: $name"; br();    
    echo"Pass: $pass";br();
}

//XSS-атака
//<script>alert`hello`</script>
// htmlspecialchars($_POST["name"]);
// htmlentities($_POST["password"]);
// strip_tags($_POST["password"]);

?>