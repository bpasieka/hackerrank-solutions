<?php
declare(strict_types=1);

$handle = fopen ('php://stdin', 'r');
fscanf($handle, '%d', $n);

$leftPart = new SplMaxHeap();
$rightPart = new SplMinHeap();

for ($i = 0; $i < $n; $i++) {
    fscanf($handle, '%d', $number);

    $leftPartLength = $leftPart->count();
    $rightPartLength = $rightPart->count();

    // Select which heap to insert the value
    if ($rightPartLength && $number > $rightPart->top()) {
        $rightPart->insert($number);
        $rightPartLength++;
    } else {
        $leftPart->insert($number);
        $leftPartLength++;
    }

    // Balance heaps
    if ($leftPartLength - $rightPartLength >= 2) {
        $rightPart->insert($leftPart->extract());
        $rightPartLength++;
        $leftPartLength--;
    } elseif ($rightPartLength - $leftPartLength >= 2) {
        $leftPart->insert($rightPart->extract());
        $leftPartLength++;
        $rightPartLength--;
    }

    // Calculate median
    $median = 0;
    if ($leftPartLength == $rightPartLength) {
        $median = ($leftPart->top() + $rightPart->top()) / 2;
    } elseif ($leftPartLength > $rightPartLength) {
        $median = $leftPart->top();
    } else {
        $median = $rightPart->top();
    }

    echo number_format($median, 1, '.', '') . "\n";
}
