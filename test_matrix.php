<?php
echo "Input row and column count: ";
$count = trim(fgets(STDIN));
$arr1 = array();
for ($i=0; $i < $count; $i+=1){
    $arr2 = array();
    for ($x=0; $x < $count; $x+=1){
        echo "Input row and ".$i." column count ".$x." :";
        $val = trim(fgets(STDIN));
        array_push($arr2,$val);
    }
    array_push($arr1,$arr2);
}

echo "N = ".$count."\n";

echo "Matrix result\n";
for ($i=0; $i < $count; $i+=1){
    for ($x=0; $x < count($arr1[$i]); $x+=1){
        echo $arr1[$i][$x]." ";
    }
    echo "\n";
}
echo DifferentSum($arr1);

function DifferentSum($arr) {
    $right = 0;
    $left = 0;
    for ($i=0; $i < count($arr); $i+=1){
        $right += $arr[$i][$i];
        $left += $arr[$i][count($arr)-1-$i];
    };
    return "Diagonal Difference result: ".abs($right-$left);
}
?>