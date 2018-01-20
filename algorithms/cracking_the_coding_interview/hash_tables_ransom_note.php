<?php
declare(strict_types=1);

const YES = 'Yes';
const NO = 'No';

/**
 * @param string[] $magazineNoteWords
 * @param string[] $ransomNoteWords
 * @return string
 */
function createReplica(array $magazineNoteWords, array $ransomNoteWords): string
{
    if (count($magazineNoteWords) < count($ransomNoteWords)) {
        return NO;
    }

    $magazineNoteMap = [];
    foreach ($magazineNoteWords as $word) {
        $magazineNoteMap[$word] = ($magazineNoteMap[$word] ?? 0) + 1;
    }

    foreach ($ransomNoteWords as $word) {
        if (!isset($magazineNoteMap[$word]) || $magazineNoteMap[$word] === 0) {
            return NO;
        }
        $magazineNoteMap[$word]--;
    }

    return YES;
}

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%d %d', $m, $n);

$magazineNoteString = fgets($handle);
$magazineNoteWords = explode(' ', trim($magazineNoteString));
$ransomNoteString = fgets($handle);
$ransomNoteWords = explode(' ', trim($ransomNoteString));

echo createReplica($magazineNoteWords, $ransomNoteWords);
