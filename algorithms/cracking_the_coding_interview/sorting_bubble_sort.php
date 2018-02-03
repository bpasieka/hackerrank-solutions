<?php
declare(strict_types=1);

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%d',$n);
$array = explode(' ', fgets($handle));
array_walk($array, 'intval');

$sortedArray = bubbleSort($array);
echo "First Element: " . reset($sortedArray) . " \n";
echo "Last Element: " . end($sortedArray) . " \n";

/**
 * @param array $array
 * @return array
 */
function bubbleSort(array $array): array
{
    $swaps = 0;
    $length = count($array);

    for ($i = 0; $i < $length; $i++) {
        for ($j = 0; $j < $length - 1; $j++) {
            // Swap adjacent elements if they are in decreasing order
            if ($array[$j] > $array[$j + 1]) {
                $swaps++;

                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }

    echo "Array is sorted in $swaps swaps. \n";

    return $array;
}