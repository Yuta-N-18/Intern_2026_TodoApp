<?

$list = [0 => "zero",2 => "two",3 => "three"];
$list[1] = "one";

foreach($list as $key => $value){
    echo "Current element of \$array: {$key}, {$value}.\n";
}

$list2 = array_values($list);

foreach($list2 as $key => $value){
    echo "Current element of \$array: {$key}, {$value}.\n";
}