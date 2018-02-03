<?php
declare(strict_types=1);

/**
 * @param int $n
 * @return int
 */
function fibonacci(int $n): int
{
    $memo = [];
    return fibonacciIter($n, $memo);
}

/**
 * @param int $n
 * @param array $memo
 * @return int
 */
function fibonacciIter(int $n, array &$memo):int
{
    if ($n === 0 || $n === 1) {
        return $n;
    }

    if (empty($memo[$n])) {
        $memo[$n] = fibonacciIter($n - 1, $memo) + fibonacciIter($n - 2, $memo);
    }

    return $memo[$n];
}

$handle = fopen ("php://stdin","r");
$n = fgets($handle);

printf("%d", fibonacci((int) $n));

fclose($handle);
