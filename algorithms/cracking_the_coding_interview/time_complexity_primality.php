<?php
declare(strict_types=1);

/**
 * @param int $n
 * @return bool
 */
function isPrime(int $n): bool
{
    if ($n <= 1) {
        return false;
    }

    for ($i = 2; $i * $i <= $n; $i++) {
        if ($n % $i === 0) {
            return false;
        }
    }

    return true;
}

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%d', $p);

for($i = 0; $i < $p; $i++) {
    fscanf($handle, '%d', $n);

    if (isPrime((int) $n)) {
        echo "Prime \n";
    } else {
        echo "Not prime \n";
    }
}
