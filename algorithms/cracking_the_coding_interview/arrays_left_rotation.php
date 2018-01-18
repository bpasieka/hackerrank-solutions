<?php
declare(strict_types=1);

/**
 * @param int[] $a
 * @param int $rotate
 * @return int[]
 */
function rotateLeft(array $a, int $rotate): array
{
    $length = count($a);
    if ($rotate > $length) {
        $rotate = $rotate % $length;
    }

    $result = [];
    for ($i = 0; $i < $length; $i++) {
        $preIndex = $i + $rotate;
        $index = ($preIndex < $length) ? $preIndex : ($preIndex - $length);
        $result[$i] = $a[$index];
    }
    return $result;
}

$handle = fopen ('php://stdin', 'r');
fscanf($handle, '%d %d', $n, $k);
$a = explode(' ', fgets($handle));
array_walk($a, 'intval');

echo implode(' ', rotateLeft($a, $k));
