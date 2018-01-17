<?php

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%s', $a);
fscanf($handle, '%s', $b);

$map = [];
$result = 0;
$aLength = strlen($a);
$bLength = strlen($b);

for ($i = 0; $i < $aLength; $i++) {
    $map[$a[$i]] = isset($map[$a[$i]]) ? $map[$a[$i]] + 1 : 1;
}

for ($i = 0; $i < $bLength; $i++) {
    if (!isset($map[$b[$i]]) || $map[$b[$i]] === 0) {
        $result++;
    } else {
        $map[$b[$i]] -= 1;
    }
}

foreach ($map as $value) {
    $result += $value;
}

echo $result;
