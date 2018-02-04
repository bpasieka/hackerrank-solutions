<?php
declare(strict_types=1);

/**
 * @param array $a
 * @return int
 */
function findUnique(array $a): int
{
    $result = 0;

    foreach ($a as $number) {
        $result ^= $number;
    }

    return $result;
}

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%d', $n);
$a = explode(' ', fgets($handle));
array_walk($a, 'intval');

echo findUnique($a);
