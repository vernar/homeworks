<?php
/*
 * год, номер которого кратен 400, — високосный;
 * остальные годы, номер которых кратен 100, — невисокосные;
 * остальные годы, номер которых кратен 4, — високосные.
 */

function checkyear($x){
   return ( $x % 4 == 0 && $x % 100 != 0 ) || $x % 400 == 0;
}

function checkyear2($x){
    return (bool) date("L", mktime(0, 0, 0, 1, 1, $x) );
}
echo '<pre>';
for ($i = 2000; $i < 20500; $i ++){
    //if(checkyear($i) != checkyear2($i)){
        echo '=======' . $i . '========<br />';
        var_dump(checkyear($i));
        var_dump(checkyear2($i));

        echo '======================= <br />';
   // }
}
echo '</pre>';