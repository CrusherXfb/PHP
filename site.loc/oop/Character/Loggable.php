<?php

trait Loggable {
    function log(string $message) {
        $file = fopen("logs.txt", "a+");
        $log = "[LOG] $message \n";
        fwrite($file, $log);
        fclose($file);
        echo $log."<br>";
    }
}
