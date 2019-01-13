<?php
$result = [];
for ($x = 1; $x < 100; $x++ ){
    for($y = 2; $y < $x && $x % $y != 0; $y++ ){
    }
    if ($x == $y){
        $result[] = $x;
    }
}

foreach ($result as $key => $value) {
    echo "<p>$value - это простое число № " . ($key+1) ." </p>";
}