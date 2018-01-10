<?php
declare(strict_types=1);

/**
 * @param int $num
 * @param array $data
 * @return int
 */
function simpleArraySum(int $num, array $data): int
{
    return array_sum($data);
}

$handle = fopen("php://stdin", "r");
fscanf($handle, "%i", $num);
$data = explode(" ", fgets($handle));
$data = array_map('intval', $data);

echo simpleArraySum($num, $data) . "\n";
