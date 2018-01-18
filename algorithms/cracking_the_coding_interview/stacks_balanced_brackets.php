<?php
declare(strict_types=1);

const YES = 'YES';
const NO = 'NO';

/**
 * @param string $brackets
 * @return string
 */
function areBalancedBrackets(string $brackets): string
{
    $stack = [];
    $length = strlen($brackets);

    for ($i = 0; $i < $length; $i++) {
        $bracket = $brackets[$i];
        if ($bracket === '(' || $bracket === '[' || $bracket === '{') {
            array_unshift($stack, $bracket);
            continue;
        }

        if (empty($stack) && ($bracket === ')' || $bracket === ']' || $bracket === '}')) {
            return NO;
        }

        $popFromStack = array_shift($stack);

        if ($bracket === ')' && $popFromStack !== '(') {
            return NO;
        }
        if ($bracket === ']' && $popFromStack !== '[') {
            return NO;
        }
        if ($bracket === '}' && $popFromStack !== '{') {
            return NO;
        }
    }

    if (!empty($stack)) {
        return NO;
    }

    return YES;
}

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%d', $t);

$result = [];
for ($a0 = 0; $a0 < $t; $a0++) {
    fscanf($handle, '%s', $expression);
    $result[] = areBalancedBrackets($expression);
}
echo implode("\n", $result);
