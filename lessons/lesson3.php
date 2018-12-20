<?php

// =================== 1 =====================
$a = 5;
$b = 3;
define('C',10);

//sum
$x = $a + $b + C;
echo $x . '<br />';

//sub
$x = C - $a - $b;
echo $x . '<br />';

//mult
$x = ($a + $b) * C;
echo $x . '<br />';

//div
$x = $a * $b / C;
echo $x . '<br />';

//mod
echo ( $a % 2 == 0 ? 'число чётное' : 'число не чётное' ) . '<br />';
echo ( C % 2 == 0 ? 'число чётное' : 'число не чётное' ) . '<br />';

// =================== 2 =====================
//y = (2x/3y + 4a0.5b) - (3c-2x)/5y
$y = 1;
$x = 5;
$a = 2;
$b = 8;
$c = 33;

$y = ( (2 * $x / 3 * $y) + (4 * $a * 0.5 * $b) ) - ( (3 * $c - 2 * $x) / (5 * $y) );
echo $y . '<br />';

// =================== 3 =====================

function calculate ($a, $b, $c = 100){
    $result = [];

    $result[1] = $a + $b + $c;
    $result[2] = $a - $b;
    $result[3] = $result[1] / $result[2];
    $result[4] = $result[3] * $c;

    return $result;
}

echo '<pre>';
print_r(calculate(5,3));
echo '</pre>';