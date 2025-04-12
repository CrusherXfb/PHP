<?php

trait Loggable {
    function log(string $message) {
        
        $log = "[LOG] $message \n";
        echo $log."<br>";


        // $file = fopen("logs.txt", "a+");
        // fwrite($file, $log);
        // fclose($file);
    }
}
