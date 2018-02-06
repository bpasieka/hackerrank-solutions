<?php
declare(strict_types=1);

/**
 * @param int[][] $grid
 * @return int
 */
function solve(array $grid): int
{
    $max = 0;

    foreach ($grid as $i => $row) {
        foreach ($row as $j => $value) {
            if ($value === 1) {
                $count = countRegion($grid, $i, $j);
                if ($count > $max) {
                    $max = $count;
                }
            }
        }
    }

    return $max;
}

/**
 * @param int[][] $grid
 * @param int $i
 * @param int $j
 * @return int
 */
function countRegion(array &$grid, int $i, int $j): int
{
    $grid[$i][$j] = 0;
    $count = 1;

    foreach ([-1, 0, 1] as $ii) {
        foreach ([-1, 0, 1] as $jj) {
            // if the same element
            if ($ii === 0 && $jj === 0) {
                continue;
            }

            $newI = $i + $ii;
            $newJ = $j + $jj;

            if (isset($grid[$newI][$newJ]) && $grid[$newI][$newJ] === 1) {
                $count += countRegion($grid, $newI, $newJ);
            }
        }
    }

    return $count;
}

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%d', $n);
fscanf($handle, '%d', $m);

$grid = [];
for($i = 0; $i < $n; $i++) {
    $grid[$i] = explode(' ', fgets($handle));
    $grid[$i] = array_map(function($value) {
        return (int) $value;
    }, $grid[$i]);
}
echo solve($grid);
