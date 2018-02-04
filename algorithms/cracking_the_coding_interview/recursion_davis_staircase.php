<?php
declare(strict_types=1);

/**
 * @param int $n
 * @return int
 */
function numberOfWays(int $n): int
{
    $memo = [];
    return numberOfWaysIter($n, 0, $memo);
}

function numberOfWaysIter(int $n, int $ways, array &$memo): int
{
    if ($n < 0) {
        return 0;
    }

    if ($n === 0) {
        $ways++;
        return $ways;
    }

    if (!empty($memo[$n])) {
        return $memo[$n];
    }

    $ways = numberOfWaysIter($n - 1, $ways, $memo)
        + numberOfWaysIter($n - 2, $ways, $memo)
        + numberOfWaysIter($n - 3, $ways, $memo);
    $memo[$n] = $ways;

    return $ways;
}

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%d', $s);

for ($i = 0; $i < $s; $i++){
    fscanf($handle, '%d', $n);

    echo numberOfWays((int) $n) . " \n";
}
