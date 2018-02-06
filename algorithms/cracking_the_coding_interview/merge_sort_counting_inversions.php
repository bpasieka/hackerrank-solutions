<?php
declare(strict_types=1);

/**
 * @param int[] $data
 * @return int
 */
function countInversions(array $data): int
{
    $count = 0;
    countInversionsIter($data, $count);

    return $count;
}

/**
 * @param int[] $data
 * @param int $count
 * @return int[]
 */
function countInversionsIter(array $data, int &$count)
{
    $length = count($data);

    if ($length <= 1) {
        return $data;
    }

    $middleIndex = (int) ($length / 2);
    $leftPart = countInversionsIter(array_slice($data, 0, $middleIndex), $count);
    $leftPartLength = count($leftPart);
    $rightPart = countInversionsIter(array_slice($data, $middleIndex), $count);
    $rightPartLength = count($rightPart);

    $leftI = 0;
    $rightI = 0;
    $result = [];

    while ($leftI < $leftPartLength || $rightI < $rightPartLength) {
        $leftElement = $leftPart[$leftI] ?? null;
        $rightElement = $rightPart[$rightI] ?? null;

        if (isset($leftElement) && !isset($rightElement)) {
            $result[] = $leftElement;
            $leftI++;
        } elseif (!isset($leftElement) && isset($rightElement)) {
            $result[] = $rightElement;
            $rightI++;
        } elseif ($leftElement <= $rightElement) {
            $result[] = $leftElement;
            $leftI++;
        } else {
            $result[] = $rightElement;
            $rightI++;
            $count += $leftPartLength - $leftI;
        }
    }

    return $result;
}

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%i', $t);
for($i = 0; $i < $t; $i++){
    fscanf($handle, '%i', $n);
    $data = array_map('intval', explode(' ', fgets($handle)));
    $swaps = countInversions($data);

    echo $swaps . "\n";
}
