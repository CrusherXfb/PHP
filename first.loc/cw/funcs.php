
<?php
function br()
{
    echo "<br>";
}

function printTitle($str, $hName = 4, $color = "black")
{
    echo "<h$hName style='color:" . $color . "'>$str</h$hName>";
}
?>