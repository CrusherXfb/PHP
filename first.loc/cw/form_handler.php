<?php

require("funcs.php");

if (isset($_POST["sbmt"])) {
    printTitle("UNIVERSITY FORM");
    $name = htmlspecialchars(string: $_POST["name"]);
    $email = htmlentities($_POST["email"]);

    echo "Name: {$name}";
    br();
    echo "Email: {$email}";
    br();
    if (isset($_POST['is_need_camp'])) {
        echo $_POST['is_need_camp'];
        br();
    } else {
        echo "not need camp";
    }
    if (isset($_POST['abiturient_type'])) {
        br();
        echo "Abiturient type: " . htmlspecialchars($_POST['abiturient_type']);
        br();
    }
    br();
    echo "Course: " . htmlspecialchars($_POST['course']);
    br();

    ?> <ul> <?php
    foreach ($_POST['contacts'] as $key => $val) {
        if ($val !== "") {
            echo "<li>".htmlspecialchars($key)." phone ".htmlspecialchars($val)."</li>"; br();
        }
    }
    echo "</ul>";



}

?>