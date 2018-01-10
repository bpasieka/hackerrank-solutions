<?php
declare(strict_types=1);

/**
 * @param int $a0
 * @param int $a1
 * @param int $a2
 * @param int $b0
 * @param int $b1
 * @param int $b2
 * @return int[]
 */
function solve(int $a0, int $a1, int $a2, int $b0, int $b1, int $b2): array
{
    $aliceRating = 0;
    $bobRating = 0;
    $aliceRates = [$a0, $a1, $a2];
    $bobRates = [$b0, $b1, $b2];

    foreach ($aliceRates as $key => $aliceRate) {
        $bobRate = $bobRates[$key];

        if ($aliceRate > $bobRate) {
            $aliceRating++;
        }

        if ($aliceRate < $bobRate) {
            $bobRating++;
        }
    }

    return [$aliceRating, $bobRating];
}

$handle = fopen ("php://stdin", "r");
fscanf($handle, "%d %d %d", $a0, $a1, $a2);
fscanf($handle, "%d %d %d", $b0, $b1, $b2);

$result = solve($a0, $a1, $a2, $b0, $b1, $b2);
echo implode(" ", $result) . "\n";
