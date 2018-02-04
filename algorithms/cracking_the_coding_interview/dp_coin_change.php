<?php
declare(strict_types=1);

/**
 * @param int $goal
 * @param int[] $coins
 * @return int
 */
function numberOfWays(int $goal, array $coins): int
{
    rsort($coins);
    $memo = [];

    return numberOfWaysIter($goal, $coins, 0, $memo);
}

/**
 * @param int $toGoal
 * @param int[] $coins
 * @param int $index
 * @param array $memo
 * @return int
 */
function numberOfWaysIter(int $toGoal, array $coins, int $index, array &$memo): int
{
    if ($toGoal < 0) {
        return 0;
    }

    if ($toGoal === 0) {
        return 1;
    }

    if ($index === count($coins) && $toGoal > 0) {
        return 0;
    }

    if (!empty($memo[$toGoal][$index])) {
        return $memo[$toGoal][$index];
    }

    $memo[$toGoal][$index] = numberOfWaysIter($toGoal - $coins[$index], $coins, $index, $memo)
        + numberOfWaysIter($toGoal, $coins, $index + 1, $memo);

    return $memo[$toGoal][$index];
}

$handle = fopen ('php://stdin', 'r');
fscanf($handle, '%d %d', $goal, $m);
$coinsString = fgets($handle);
$coins = explode(' ', $coinsString);
array_walk($coins, 'intval');

echo numberOfWays($goal, $coins);
