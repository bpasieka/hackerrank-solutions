<?php
declare(strict_types=1);

/**
 * @param string $s
 * @return string
 */
function superReducedString(string $s): string
{
    if (!$s) {
        return 'Empty String';
    }

    $result = '';
    $length = strlen($s);

    $i = 0;
    while ($i < $length) {
        if (!isset($s[$i + 1]) || $s[$i] !== $s[$i + 1]) {
            $result .= $s[$i];
            $i += 1;
            continue;
        }

        if (isset($s[$i + 1]) && $s[$i] === $s[$i + 1]) {
            $i += 2;
            continue;
        }
    }

    if ($result === $s) {
        return $result;
    }

    return superReducedString($result);
}

$handle = fopen ("php://stdin", "r");
fscanf($handle, "%s", $s);

echo superReducedString($s) . "\n";
