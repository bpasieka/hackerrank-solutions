<?php
declare(strict_types=1);

/**
 * @param int[] $flavors
 * @param int $money
 */
function solve(array $flavors, int $money)
{
    $map = [];
    $result = [];

    foreach ($flavors as $index => $flavor) {
        if (!empty($map[$flavor])) {
            $result = [$index + 1, $map[$flavor]];
            break;
        }

        $map[$money - $flavor] = $index + 1;
    }

    sort($result);
    echo $result[0] . ' ' . $result[1] . "\n";
}

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%i', $t);
for ($i = 0; $i < $t; $i++) {
    fscanf($handle, '%i', $money);
    fscanf($handle, '%i', $n);
    $flavors = array_map('intval', explode(' ', fgets($handle)));
    solve($flavors, $money);
}
